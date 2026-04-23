<?php

namespace Tests\Feature;

use App\Mail\NewsletterSubscribedMail;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class NewsletterControllerTest extends TestCase
{
    public function test_newsletter_subscription_sends_email(): void
    {
        Mail::fake();

        $this->from('/')
            ->post(route('newsletter.subscribe'), [
                'email' => 'test@example.com',
                'language' => 'hu',
            ])
            ->assertRedirect('/');

        Mail::assertSent(NewsletterSubscribedMail::class);
    }
}
