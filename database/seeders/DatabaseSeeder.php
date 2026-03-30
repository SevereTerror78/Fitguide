<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
        ProductTypeSeeder::class,
        ProductSeeder::class,
        AdvicesSeeder::class,
        MusclesSeeder::class,
<<<<<<< HEAD
<<<<<<< HEAD
        AdminDiscountSeeder::class,
        RewardShopItemSeeder::class,
=======
=======
>>>>>>> 5c55d34 (new features)
        MusclesHuSeeder::class,
        AdminDiscountSeeder::class,
        RewardShopItemSeeder::class,
        ExercisesSeeder::class,
        
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
    ]);

    }
}
