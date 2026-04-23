<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewsletterSubscribedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public string $email)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('emails.newsletter.subject'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.newsletter_subscribed',
            with: [
                'email' => $this->email,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}