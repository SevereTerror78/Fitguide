<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdvicesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('advices')->upsert([
            ['category' => 'underweight', 'created_at' => now(), 'updated_at' => now()],
            ['category' => 'normal',      'created_at' => now(), 'updated_at' => now()],
            ['category' => 'overweight',  'created_at' => now(), 'updated_at' => now()],
            ['category' => 'obese',       'created_at' => now(), 'updated_at' => now()],
        ], ['category'], ['updated_at']);
    }
}