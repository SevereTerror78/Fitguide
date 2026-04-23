<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RewardShopItem;

class RewardShopItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name' => '5% Discount Coupon',
                'description' => '5% off your next purchase',
                'required_points' => 200,
                'image' => 'images/discount5.png',
            ],
            [
                'name' => '10% Discount Coupon',
                'description' => '10% off your next purchase',
                'required_points' => 500,
                'image' => 'images/discount10.png',
            ],
            [
                'name' => '20% Discount Coupon',
                'description' => '20% off your next purchase',
                'required_points' => 900,
                'image' => 'images/discount20.png',
            ],
        ];

        foreach ($items as $item) {
            RewardShopItem::create($item);
        }
    }
}