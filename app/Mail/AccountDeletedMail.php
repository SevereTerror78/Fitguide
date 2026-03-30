<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AccountDeletedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $name
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('emails.account_deleted.subject'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.account_deleted',
            with: [
                'name' => $this->name,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}