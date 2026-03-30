<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Muscle;

class ExercisesController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category', 'all');
        $muscleSlug = $request->get('muscle');
        $type = $request->get('type'); // free / equipment

        $categories = [
            'arm' => 'Arms',
            'body' => 'Body',
            'leg' => 'Legs'
        ];

        $muscles = \App\Models\Muscle::when($category !== 'all', function ($q) use ($category) {
            $q->where('category', $category);
        })->get();

        $exercises = collect();

        if ($muscleSlug) {

            $muscle = Muscle::where('slug', $muscleSlug)->first();

            if ($muscle) {
                $exercises = $muscle->exercises()
                    ->when($type, function ($q) use ($type) {
                        $q->where('video_url', 'like', "%_$type%");
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
