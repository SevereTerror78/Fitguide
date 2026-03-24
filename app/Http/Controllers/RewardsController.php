<?php

namespace App\Http\Controllers;

use App\Models\RewardShopItem;
use App\Models\RedeemedReward;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RewardsController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        // UGYANAZ, mint a Profile Summary: users.points
        $totalPoints = (int) $user->points;

        $shopItems = RewardShopItem::query()->latest()->get();

        $redeemed = RedeemedReward::with('item')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('profile.rewards', compact('totalPoints', 'shopItems', 'redeemed'));
    }

    public function redeem(Request $request, RewardShopItem $item)
    {
        /** @var User $user */
        $user = Auth::user();

        DB::transaction(function () use ($user, $item) {
            // lockoljuk a user sort, hogy ne lehessen duplán kattintással túlkölteni
            $freshUser = User::whereKey($user->id)->lockForUpdate()->firstOrFail();

            abort_if($freshUser->points < (int) $item->required_points, 403, 'Not enough points.');

            // levonás
            $freshUser->decrement('points', (int) $item->required_points);

            // naplózás
            RedeemedReward::create([
                'user_id' => $freshUser->id,
                'reward_shop_item_id' => $item->id,
                'points_spent' => (int) $item->required_points,
                'status' => 'pending',
            ]);
        });

        return back()->with('success', 'Redeemed! (pending)');
    }
}
