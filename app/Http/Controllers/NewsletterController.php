<?php

namespace App\Http\Controllers;

use App\Mail\NewsletterSubscribedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'language' => ['nullable', 'in:hu,en'],
        ]);

        $locale = $validated['language'] ?? app()->getLocale() ?? 'hu';

        Mail::to($validated['email'])
            ->locale($locale)
            ->send(new NewsletterSubscribedMail($validated['email']));

        return back()->with('success', __('footer.subscribe_success'));
    }
}