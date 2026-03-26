<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RewardShopItem extends Model
{
   protected $fillable = [
        'name',
        'required_points',
        'image',
    ];

}
