<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use Illuminate\Http\Request;
=======
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
>>>>>>> fc7673c (frontend update and some new feature)

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

<<<<<<< HEAD
    public function update(Request $request)
    {
        $validated = $request->validate([
            'language' => 'required|in:hu,en',
            'theme'    => 'required|in:light,dark,colorblind',
            'currency' => 'required|in:HUF,EUR,USD',
        ]);

        $user = auth()->user();

        $user->update([
            'language' => $validated['language'],
            'theme'    => $validated['theme'],
            'currency' => $validated['currency'],
        ]);

        return redirect()
            ->route('settings.index')
            ->with('success', 'Settings updated successfully.');
    }
}
=======
    /**
     * Save changes (language + theme + currency) via the main Settings form.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'language' => ['required', 'in:en,hu'],
            'theme'    => ['required', 'in:light,dark,hc'],
            'currency' => ['required', 'in:HUF,EUR,USD'],
        ]);

        /** @var User $user */
        $user = Auth::user();

        $user->language = $validated['language'];
        $user->theme    = $validated['theme'];
        $user->currency = $validated['currency'];
        $user->save();

        // Apply locale immediately
        $request->session()->put('locale', $validated['language']);

        return redirect()
            ->route('settings.index')
            ->with('success', __('settings.saved'));
    }

    /**
     * Instant language switch (select change -> POST -> back).
     * Updates only the language without touching theme/currency.
     */
    public function updateLanguage(Request $request)
    {
        $validated = $request->validate([
            'language' => ['required', 'in:en,hu'],
        ]);

        /** @var User $user */
        $user = Auth::user();

        $user->language = $validated['language'];
        $user->save();

        // Apply locale immediately
        $request->session()->put('locale', $validated['language']);

        return redirect()->back();
    }
}
>>>>>>> fc7673c (frontend update and some new feature)
