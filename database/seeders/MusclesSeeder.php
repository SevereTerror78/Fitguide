<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Muscle;

class MusclesSeeder extends Seeder
{
    public function run(): void
    {
        $muscles = [
<<<<<<< HEAD
            // Arm
=======

>>>>>>> fc7673c (frontend update and some new feature)
            ['name' => 'Biceps', 'slug' => 'biceps', 'category' => 'arm'],
            ['name' => 'Triceps', 'slug' => 'triceps', 'category' => 'arm'],
            ['name' => 'Forearm', 'slug' => 'forearm', 'category' => 'arm'],

<<<<<<< HEAD
            // Body
=======
>>>>>>> fc7673c (frontend update and some new feature)
            ['name' => 'Pectoral muscle', 'slug' => 'pectoral', 'category' => 'body'],
            ['name' => 'Back muscle', 'slug' => 'back_muscle', 'category' => 'body'],
            ['name' => 'Shoulder muscle', 'slug' => 'vall', 'category' => 'body'],
            ['name' => 'Abdominal muscle', 'slug' => 'abdominal_muscle', 'category' => 'body'],

<<<<<<< HEAD
            // Leg
=======
>>>>>>> fc7673c (frontend update and some new feature)
            ['name' => 'Thigh', 'slug' => 'thigh', 'category' => 'leg'],
            ['name' => 'Calf', 'slug' => 'calf', 'category' => 'leg'],
            ['name' => 'Buttock', 'slug' => 'buttock', 'category' => 'leg'],
        ];

        foreach ($muscles as $muscle) {
            Muscle::create($muscle);
        }
    }
}
