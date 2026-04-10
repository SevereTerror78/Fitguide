<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductType;

class ProductTypeSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
<<<<<<< HEAD
            ['name' => 'Supplements',     'slug' => 'supplements'],
            ['name' => 'Snacks',          'slug' => 'snacks'],
            ['name' => 'Equipment',       'slug' => 'equipment'],
            ['name' => 'Clothing',        'slug' => 'clothing'],
            ['name' => 'Accessories',     'slug' => 'accessories'],
            ['name' => 'Packages & Gift', 'slug' => 'packages-gift'],
        ];

        // Válaszd EGYIKET:
        foreach ($rows as $r) {
            ProductType::updateOrCreate(
                ['slug' => $r['slug']],   // egyedi kulcs
                ['name' => $r['name']]    // frissítendő mezők
            );
        }
        // VAGY:
        // ProductType::upsert($rows, ['slug'], ['name']);
    }
}
=======
            ['name' => 'Supplements',     'name_hu' => 'Kiegészítők',        'slug' => 'supplements'],
            ['name' => 'Snacks',          'name_hu' => 'Snackek',            'slug' => 'snacks'],
            ['name' => 'Equipment',       'name_hu' => 'Felszerelés',        'slug' => 'equipment'],
            ['name' => 'Clothing',        'name_hu' => 'Ruházat',            'slug' => 'clothing'],
            ['name' => 'Accessories',     'name_hu' => 'Kiegészítők',        'slug' => 'accessories'],
            ['name' => 'Packages & Gift', 'name_hu' => 'Csomagok & Ajándék', 'slug' => 'packages-gift'],
        ];

        foreach ($rows as $r) {
            ProductType::updateOrCreate(
                ['slug' => $r['slug']],
                [
                    'name' => $r['name'],
                    'name_hu' => $r['name_hu'],
                ]
            );
        }
    }
}
>>>>>>> fc7673c (frontend update and some new feature)
