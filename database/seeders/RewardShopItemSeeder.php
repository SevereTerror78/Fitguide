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
<<<<<<< HEAD
<<<<<<< HEAD
                'name' => 'FitGuide Shaker Bottle',
                'description' => 'Stylish protein shaker',
                'required_points' => 800,
                'image' => 'rewards/shaker.png',
            ],
            [
                'name' => 'Protein Bar',
                'description' => 'Chocolate whey bar',
                'required_points' => 250,
                'image' => 'rewards/protein-bar.png',
            ],
            [
                'name' => '10% Discount Coupon',
                'description' => 'Use on your next purchase',
                'required_points' => 500,
                'image' => 'rewards/discount10.png',
=======
=======
>>>>>>> 5c55d34 (new features)
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
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
            ],
        ];

        foreach ($items as $item) {
            RewardShopItem::create($item);
        }
    }
<<<<<<< HEAD
<<<<<<< HEAD
}
=======
}
>>>>>>> fc7673c (frontend update and some new feature)
=======
}
>>>>>>> 5c55d34 (new features)
