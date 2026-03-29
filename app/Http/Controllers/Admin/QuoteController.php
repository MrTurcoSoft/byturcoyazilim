<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use App\Services\GoogleCalendarService;
use App\Mail\MeetingInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class QuoteController extends Controller
{
    public function __construct(protected GoogleCalendarService $calendarService)
    {
    }

    public function index()
    {
        $quotes = Quote::latest()->paginate(20);
        return view('admin.quotes.index', compact('quotes'));
    }

    public function show(Quote $quote)
    {
        $calendarConnected = $this->calendarService->isConnected(auth()->user());
        return view('admin.quotes.show', compact('quote', 'calendarConnected'));
    }

    public function update(Request $request, Quote $quote)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,reviewing,quoted,accepted,rejected',
            'admin_notes' => 'nullable|string',
            'quoted_amount' => 'nullable|numeric|min:0',
        ]);

        $quote->update($validated);

        return back()->with('success', 'Teklif güncellendi.');
    }

    public function addToCalendar(Quote $quote)
    {
        if (!$quote->preferred_date) {
            return back()->with('error', 'Bu teklif için toplantı tarihi belirtilmemiş.');
        }

        if (!$this->calendarService->isConnected(auth()->user())) {
            return back()->with('error', 'Önce Google Calendar bağlantısı yapmalısınız.');
        }

        if ($quote->calendar_event_id) {
            return back()->with('error', 'Bu teklif zaten takvime eklenmiş.');
        }

        try {
            $startTime = Carbon::parse($quote->preferred_date->format('Y-m-d') . ' ' . ($quote->preferred_time ?? '10:00'));
            $endTime = $startTime->copy()->addHour();

            $result = $this->calendarService->createEventWithMeet(auth()->user(), [
                'summary' => 'Toplantı: ' . $quote->name . ' - ' . $quote->project_type,
                'description' => "Müşteri: {$quote->name}\nE-posta: {$quote->email}\nTelefon: {$quote->phone}\nFirma: {$quote->company}\n\nProje: {$quote->project_description}",
                'start' => $startTime->toIso8601String(),
                'end' => $endTime->toIso8601String(),
                'attendee_email' => $quote->email,
            ]);

            if ($result) {
                $quote->update([
                    'calendar_event_id' => $result['event_id'],
                    'meet_link' => $result['meet_link'],
                ]);

                // Send meeting invitation email to customer
                try {
                    Mail::to($quote->email)->send(new MeetingInvitation($quote, $startTime, $endTime));
                } catch (\Exception $e) {
                    \Log::error('Failed to send meeting invitation: ' . $e->getMessage());
                }

                $message = 'Toplantı Google Calendar\'a eklendi!';
                if ($result['meet_link']) {
                    $message .= ' Google Meet linki müşteriye e-posta ile gönderildi.';
                }
                
                return back()->with('success', $message);
            }

            return back()->with('error', 'Takvime eklenemedi.');
        } catch (\Exception $e) {
            return back()->with('error', 'Takvime eklenemedi: ' . $e->getMessage());
        }
    }

    public function removeFromCalendar(Quote $quote)
    {
        if (!$quote->calendar_event_id) {
            return back()->with('error', 'Bu teklif takvimde değil.');
        }

        try {
            $this->calendarService->deleteEvent(auth()->user(), $quote->calendar_event_id);
            $quote->update([
                'calendar_event_id' => null,
                'meet_link' => null,
            ]);

            return back()->with('success', 'Toplantı takvimden kaldırıldı.');
        } catch (\Exception $e) {
            return back()->with('error', 'Takvimden kaldırılamadı: ' . $e->getMessage());
        }
    }

    public function destroy(Quote $quote)
    {
        // Remove from calendar if exists
        if ($quote->calendar_event_id && $this->calendarService->isConnected(auth()->user())) {
            try {
                $this->calendarService->deleteEvent(auth()->user(), $quote->calendar_event_id);
            } catch (\Exception $e) {
                // Ignore calendar deletion errors
            }
        }

        $quote->delete();
        return redirect()->route('admin.quotes.index')->with('success', 'Teklif silindi.');
    }
}
