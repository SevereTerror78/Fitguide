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
            'abs' => 'abdominal_muscle',
            'biceps' => 'biceps',
            'triceps' => 'triceps',
            'forearm' => 'forearm',
            'back' => 'back_muscle',
            'chest' => 'pectoral',
            'shoulder' => 'vall',
            'thigh' => 'thigh',
            'calf' => 'calf',
            'butt' => 'buttock',
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
            if (!$muscle) continue;

            $exercise = Exercise::create([
                'name' => ucfirst($muscleKey) . ' (' . ucfirst($type) . ')',
                'description' => ucfirst($type) . ' exercise for ' . $muscle->name,
                'video_url' => 'videos/' . $video->getFilename(),
            ]);

            $exercise->muscles()->attach($muscle->id);
        }
    }
}
