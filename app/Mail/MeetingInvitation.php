<?php

namespace App\Mail;

use App\Models\Quote;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MeetingInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Quote $quote,
        public Carbon $startTime,
        public Carbon $endTime
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Toplantı Davetiyesi: ' . $this->quote->project_type,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.meeting-invitation',
        );
    }
}
