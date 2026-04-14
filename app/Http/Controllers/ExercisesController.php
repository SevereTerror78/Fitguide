<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Muscle;
use App\Models\Exercise;

class ExercisesController extends Controller
{
    public function index(Request $request)
    {
        $category   = $request->get('category', 'all');
        $muscleSlug = $request->get('muscle');
        $type       = $request->get('type');

        $categories = [
            'arm'  => 'arm',
            'body' => 'body',
            'leg'  => 'leg',
        ];

        $muscles = Muscle::query()
            ->when($category !== 'all', function ($q) use ($category) {
                $q->where('category', $category);
            })
            ->get();


        $query = Exercise::query();

        if ($muscleSlug) {
            $query->whereHas('muscles', function ($q) use ($muscleSlug) {
                $q->where('slug', $muscleSlug);
            });
        }

        if ($category !== 'all') {
            $query->whereHas('muscles', function ($q) use ($category) {
                $q->where('category', $category);
            });
        }

        if ($type) {
            $query->where('video_url', 'like', "%_{$type}%");
        }

        $exercises = $query->get();

        return view('exercises.index', compact(
            'categories',
            'category',
            'muscles',
            'exercises'
        ));
    }
}