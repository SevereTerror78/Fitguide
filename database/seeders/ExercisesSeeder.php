<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exercise;
use App\Models\Muscle;
use Illuminate\Support\Facades\File;

class ExercisesSeeder extends Seeder
{
    public function run(): void
    {
        $videos = File::files(public_path('videos'));

        $map = [
            'abs'      => 'abdominal_muscle',
            'biceps'   => 'biceps',
            'triceps'  => 'triceps',
            'forearm'  => 'forearm',
            'back'     => 'back_muscle',
            'chest'    => 'pectoral',
            'shoulder' => 'vall',
            'thigh'    => 'thigh',
            'calf'     => 'calf',
            'butt'     => 'buttock',
        ];

        $typeHu = [
            'free' => 'szabad súlyos',
            'equipment' => 'eszközös',
            'machine' => 'gépes',
        ];

        foreach ($videos as $video) {

            $filename = pathinfo($video, PATHINFO_FILENAME);
            $parts = explode('_', $filename);

            $muscleKey = $parts[0];
            $type = $parts[1] ?? 'free';

            if (!isset($map[$muscleKey])) {
                continue;
            }

            $muscle = Muscle::where('slug', $map[$muscleKey])->first();
            if (!$muscle) {
                continue;
            }

            $nameEn = ucfirst($muscleKey) . ' (' . ucfirst($type) . ')';
            $descEn = ucfirst($type) . ' exercise for ' . $muscle->name;

            $prettyTypeHu = $typeHu[$type] ?? $type;
            $muscleHuName = $muscle->name_hu ?: $muscle->name;

            $nameHu = ucfirst($muscleKey) . ' (' . $prettyTypeHu . ')';
            $descHu = $prettyTypeHu . ' gyakorlat: ' . $muscleHuName;

            $exercise = Exercise::create([
                'name' => $nameEn,
                'name_hu' => $nameHu,
                'description' => $descEn,
                'description_hu' => $descHu,
                'video_url' => 'videos/' . $video->getFilename(),
            ]);

            $exercise->muscles()->attach($muscle->id);
        }
    }
}