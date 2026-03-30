<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\RewardShopItem;
use App\Models\RedeemedReward;
use Illuminate\Support\Facades\Hash;
use App\Models\Discount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
<<<<<<< HEAD
=======
use App\Mail\AccountDeletedMail;
use Illuminate\Support\Facades\Mail;
>>>>>>> 5c55d34 (new features)


class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        return view('profile.index', [
            'user' => $user,
            'ordersCount' => $user->orders()->count(),
            'points' => $user->points ?? 0,
        ]);
    }
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function rewards(Request $request): View
    {
        $user = $request->user();

        return view('profile.rewards', [
            'user' => $user,
            'totalPoints' => $user->points ?? 0,
            'redeemed' => $user->redeemedRewards()->with('item')->latest()->get(),
            'shopItems' => RewardShopItem::all()
        ]);
    }


    public function discounts(Request $request): View
    {
        $user = $request->user();

        $discounts = Discount::query()
            ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->get();

        return view('profile.discounts', [
            'user' => $user,
            'discounts' => $discounts
        ]);
    }



    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validatedData = $request->validated();

<<<<<<< HEAD
<<<<<<< HEAD
        // Profilkép
        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::delete('public/' . $user->profile_picture);
            }
            $validatedData['profile_picture'] =
                $request->file('profile_picture')->store('profile_pictures', 'public');
        }

=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
        // Mentés ELŐTT: teljes volt-e már?
        $previousCompleted = ($user->phone && $user->dob && $user->gender);

        $user->fill($validatedData);
        $user->save();

        // Mentés UTÁN: most már teljes?
        $nowCompleted = ($user->phone && $user->dob && $user->gender);

       if (!$previousCompleted && $nowCompleted && !$user->profile_bonus_claimed) {
            $user->increment('points', 25);

            $user->update([
                'profile_bonus_claimed' => true,
                'profile_bonus_claimed_at' => now(),
            ]);

            return Redirect::route('profile.index')
                ->with('success', 'Profile completed! +25 points earned!');
        }

        // sima mentés után is profile.index
        return Redirect::route('profile.index')
            ->with('success', 'Profile updated successfully!');
    }


    public function redeem(Request $request, RewardShopItem $item)
    {
        $user = $request->user();

        return DB::transaction(function () use ($user, $item) {

            // Lock a user sorra, hogy ne lehessen duplán kattintással túlkölteni
            $freshUser = User::whereKey($user->id)->lockForUpdate()->firstOrFail();

            if ($freshUser->points < (int) $item->required_points) {
                return back()->with('error', 'Not enough points!');
            }

            // Pontlevonás
            $freshUser->decrement('points', (int) $item->required_points);

            // 1) MINDIG: history a redeemed_rewards táblába
            RedeemedReward::create([
                'user_id' => $freshUser->id,
                'reward_shop_item_id' => $item->id,
                'points_spent' => (int) $item->required_points,
                'status' => 'granted', // ha azonnal jóváhagyott; ha kell admin, legyen 'pending'
            ]);

            // 2) CSAK DISCOUNT esetén: discounts táblába is
            $isDiscount = str_contains(strtolower($item->name), 'discount') || str_contains($item->name, '%');

            if ($isDiscount) {
                // százalék kinyerése a névből: "10% Discount Coupon" -> 10
                $amount = 0;
                if (preg_match('/(\d{1,2})\s*%/', $item->name, $m)) {
                    $amount = (int) $m[1];
                }
                if ($amount <= 0) {
                    $amount = 10; // fallback
                }

                // kuponkód generálás
                $code = 'FG' . $amount . '-' . strtoupper(Str::random(6));

                Discount::create([
                    'user_id' => $freshUser->id,
                    'discountCode' => $code,
                    'discountAmount' => $amount,
                    'expiryDate' => now()->addMonths(6),
                    'usedOrNot' => false,
                ]);
            }

            return back()->with('success', 'Redeemed successfully!');
        });
    }



    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
<<<<<<< HEAD
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();

        if ($user->profile_picture) {
            Storage::delete('public/' . $user->profile_picture);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
=======
            'confirmation_text' => ['required', 'string'],
        ]);
        
        if ($request->input('confirmation_text') !== 'DELETEACCOUNT') {
            return back()->withErrors([
                'confirmation_text' => __('profile.delete_confirmation_invalid'),
            ], 'userDeletion');
        }
    
        $user = $request->user();
    
        Mail::to($user->email)
            ->locale($user->language ?? 'hu')
            ->send(new AccountDeletedMail($user->name));
    
        Auth::logout();
    
        if ($user->profile_picture) {
            Storage::delete('public/' . $user->profile_picture);
        }
    
        $user->delete();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return Redirect::to('/');
    }
    
>>>>>>> 5c55d34 (new features)
    public function security(Request $request)
    {
        return view('profile.security', ['user' => $request->user()]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = $request->user();
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password updated successfully!');
    }
   

}
