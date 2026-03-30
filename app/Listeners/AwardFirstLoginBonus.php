<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\User;

class AwardFirstLoginBonus
{
    public function handle(Login $event): void
    {
        /** @var User $user */
        $user = $event->user;

        // Admin ne kapjon
        if ($user->role === 'admin') {
            return;
        }

        // Egyszeri bónusz
        if ($user->first_login_bonus_claimed) {
            return;
        }

        $user->increment('points', 75);

        $user->update([
            'first_login_bonus_claimed' => true,
            'first_login_bonus_claimed_at' => now(),
        ]);
    }
}
