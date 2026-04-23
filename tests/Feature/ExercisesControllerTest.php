<?php

namespace Tests\Feature;

use App\Models\Exercise;
use App\Models\Muscle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExercisesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_exercises_index_loads_with_filters(): void
    {
        $muscle = Muscle::query()->create([
            'name' => 'Biceps',
            'slug' => 'biceps',
            'category' => 'arm',
        ]);

        $exercise = Exercise::query()->create([
            'name' => 'Curl',
            'description' => 'Test',
            'video_url' => 'curl_gym.mp4',
        ]);

        $exercise->muscles()->attach($muscle->id);

        $this->get(route('exercises.index', ['category' => 'arm', 'muscle' => 'biceps']))
            ->assertOk()
            ->assertViewIs('exercises.index')
            ->assertViewHas('exercises');
    }
}
