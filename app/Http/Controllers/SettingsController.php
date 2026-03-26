<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

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
