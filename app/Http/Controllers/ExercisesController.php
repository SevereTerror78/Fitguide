<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Muscle;

class ExercisesController extends Controller
{
    public function index(Request $request)
    {
        $category  = $request->get('category', 'all');
        $muscleSlug = $request->get('muscle');
        $type      = $request->get('type'); // free / equipment

        // Only keys here. Labels come from lang files in the view.
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

        return view('exercises.index', compact(
            'categories',
            'category',
            'muscles',
            'exercises'
        ));
    }
}