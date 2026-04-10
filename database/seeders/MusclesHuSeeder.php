<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Muscle;

class MusclesHuSeeder extends Seeder
{
    public function run(): void
    {
        $hu = [
            'biceps' => 'Bicepsz',
            'triceps' => 'Tricepsz',
            'forearm' => 'Alkar',
            'pectoral' => 'Mellizom',
            'back_muscle' => 'Hátizom',
            'vall' => 'Vállizom',
            'abdominal_muscle' => 'Hasizom',
            'thigh' => 'Comb',
            'calf' => 'Vádli',
            'buttock' => 'Farizom',
        ];

        foreach ($hu as $slug => $nameHu) {
            Muscle::where('slug', $slug)->update(['name_hu' => $nameHu]);
        }
    }
}