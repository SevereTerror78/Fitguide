<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RedeemedReward extends Model
{
    protected $table = 'redeemed_rewards';

    protected $fillable = [
        'user_id',
        'reward_shop_item_id',
        'points_spent',
        'status',
    ];

    public function item()
    {
        return $this->belongsTo(RewardShopItem::class, 'reward_shop_item_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
