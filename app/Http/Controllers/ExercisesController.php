<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Muscle;
<<<<<<< HEAD
=======
use App\Models\Exercise;
>>>>>>> 5c55d34 (new features)

class ExercisesController extends Controller
{
    public function index(Request $request)
    {
<<<<<<< HEAD
        $category  = $request->get('category', 'all');
        $muscleSlug = $request->get('muscle');
        $type      = $request->get('type'); // free / equipment

        // Only keys here. Labels come from lang files in the view.
=======
        $category   = $request->get('category', 'all');
        $muscleSlug = $request->get('muscle');
        $type       = $request->get('type');

>>>>>>> 5c55d34 (new features)
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

<<<<<<< HEAD
        $exercises = collect();

        if ($muscleSlug) {
            $muscle = Muscle::where('slug', $muscleSlug)->first();

            if ($muscle) {
                $exercises = $muscle->exercises()
                    ->when($type, function ($q) use ($type) {
                        // Filenames like: abs_free_xxx.mp4
                        $q->where('video_url', 'like', "%_{$type}%");
                    })
                    ->get();
            }
        }

=======

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

>>>>>>> 5c55d34 (new features)
        return view('exercises.index', compact(
            'categories',
            'category',
            'muscles',
            'exercises'
        ));
    }
}