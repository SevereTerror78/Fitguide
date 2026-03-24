<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Order;
use App\Models\Discount;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

   protected $fillable = [
    'name',
    'email',
    'password',
    'phone',
    'dob',
    'gender',
    'profile_picture',
    'role',
    'points',

    'first_login_bonus_claimed',
    'profile_bonus_claimed',
    'first_login_bonus_claimed_at',
    'profile_bonus_claimed_at',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob' => 'date',
        'password' => 'hashed',

        'first_login_bonus_claimed' => 'boolean',
        'profile_bonus_claimed' => 'boolean',
        'first_login_bonus_claimed_at' => 'datetime',
        'profile_bonus_claimed_at' => 'datetime',
    ];


    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }
    public function redeemedRewards()
    {
        return $this->hasMany(RedeemedReward::class);
    }


}
