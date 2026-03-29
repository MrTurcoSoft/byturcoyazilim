<?php

namespace App\Services;

use App\Models\GoogleToken;
use App\Models\User;
use Google\Client;
use Google\Service\Calendar;

class GoogleCalendarService
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setClientId(env('GOOGLE_CLIENT_ID'));
        $this->client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $this->client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $this->client->addScope(Calendar::CALENDAR);
        $this->client->addScope(Calendar::CALENDAR_EVENTS);
        $this->client->setAccessType('offline');
        $this->client->setPrompt('consent');
    }

    public function getAuthUrl(): string
    {
        return $this->client->createAuthUrl();
    }

    public function handleCallback(string $code, User $user): GoogleToken
    {
        $token = $this->client->fetchAccessTokenWithAuthCode($code);
        
        return GoogleToken::updateOrCreate(
            ['user_id' => $user->id],
            [
                'access_token' => $token['access_token'],
                'refresh_token' => $token['refresh_token'] ?? null,
                'expires_at' => now()->addSeconds($token['expires_in'] ?? 3600),
            ]
        );
    }

    public function getClient(User $user): ?Client
    {
        $token = GoogleToken::where('user_id', $user->id)->first();
        
        if (!$token) {
            return null;
        }

        $this->client->setAccessToken([
            'access_token' => $token->access_token,
            'refresh_token' => $token->refresh_token,
            'expires_in' => $token->expires_at ? $token->expires_at->diffInSeconds(now()) : 3600,
        ]);

        // Refresh token if expired
        if ($this->client->isAccessTokenExpired() && $token->refresh_token) {
            $newToken = $this->client->fetchAccessTokenWithRefreshToken($token->refresh_token);
            
            $token->update([
                'access_token' => $newToken['access_token'],
                'expires_at' => now()->addSeconds($newToken['expires_in'] ?? 3600),
            ]);
        }

        return $this->client;
    }

    /**
     * Create calendar event with Google Meet
     */
    public function createEventWithMeet(User $user, array $data): ?array
    {
        $client = $this->getClient($user);
        
        if (!$client) {
            return null;
        }

        $service = new Calendar($client);

        // Create event with Google Meet conferencing
        $event = new Calendar\Event([
            'summary' => $data['summary'],
            'description' => $data['description'] ?? '',
            'start' => [
                'dateTime' => $data['start'],
                'timeZone' => 'Europe/Istanbul',
            ],
            'end' => [
                'dateTime' => $data['end'],
                'timeZone' => 'Europe/Istanbul',
            ],
            'attendees' => isset($data['attendee_email']) ? [
                ['email' => $data['attendee_email']]
            ] : [],
            'conferenceData' => [
                'createRequest' => [
                    'requestId' => uniqid('meet-'),
                    'conferenceSolutionKey' => [
                        'type' => 'hangoutsMeet'
                    ]
                ]
            ],
            'reminders' => [
                'useDefault' => false,
                'overrides' => [
                    ['method' => 'email', 'minutes' => 60],
                    ['method' => 'popup', 'minutes' => 30],
                ],
            ],
        ]);

        // conferenceDataVersion=1 is required to create Meet link
        $createdEvent = $service->events->insert('primary', $event, [
            'conferenceDataVersion' => 1,
            'sendUpdates' => 'all' // Send email invites to attendees
        ]);
        
        // Extract Meet link
        $meetLink = null;
        if ($createdEvent->getConferenceData() && $createdEvent->getConferenceData()->getEntryPoints()) {
            foreach ($createdEvent->getConferenceData()->getEntryPoints() as $entryPoint) {
                if ($entryPoint->getEntryPointType() === 'video') {
                    $meetLink = $entryPoint->getUri();
                    break;
                }
            }
        }
        
        return [
            'event_id' => $createdEvent->id,
            'meet_link' => $meetLink,
            'html_link' => $createdEvent->htmlLink,
        ];
    }

    /**
     * Create calendar event without Meet (legacy method)
     */
    public function createEvent(User $user, array $data): ?string
    {
        $result = $this->createEventWithMeet($user, $data);
        return $result ? $result['event_id'] : null;
    }

    public function deleteEvent(User $user, string $eventId): bool
    {
        $client = $this->getClient($user);
        
        if (!$client) {
            return false;
        }

        $service = new Calendar($client);

        try {
            $service->events->delete('primary', $eventId);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function isConnected(User $user): bool
    {
        $token = GoogleToken::where('user_id', $user->id)->first();
        return $token !== null;
    }

    public function disconnect(User $user): void
    {
        GoogleToken::where('user_id', $user->id)->delete();
    }
}
