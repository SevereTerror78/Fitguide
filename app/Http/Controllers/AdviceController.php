<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Models\Advice; // <- importáld a modellt
=======
use App\Models\Advice;
>>>>>>> fc7673c (frontend update and some new feature)

class AdviceController extends Controller
{
    public function index()
    {
        return view('advice.index');
    }

<<<<<<< HEAD
    public function calculateBMI(Request $request)
    {
        $request->validate([
            'weight' => 'required|numeric|min:20|max:300',
            'height' => 'required|numeric|min:100|max:250',
        ]);

        $weight = $request->input('weight');
        $height = $request->input('height') / 100;

        $bmi = $weight / ($height * $height);

        $category = match (true) {
            $bmi < 18.5 => 'Underweight',
            $bmi < 25 => 'Normal weight',
            $bmi < 30 => 'Overweight',
            default => 'Obese',
        };

        // BMI pozíció kiszámítása
=======
    public function bmi(Request $request)
    {
        $data = $request->validate([
            'weight' => ['required', 'numeric', 'min:20', 'max:300'],
            'height' => ['required', 'numeric', 'min:100', 'max:250'], // cm
        ]);

        $weight = (float) $data['weight'];
        $heightCm = (float) $data['height'];
        $heightM = $heightCm / 100;

        $bmi = $weight / ($heightM * $heightM);
        $bmiRounded = round($bmi, 1);

        // category key: underweight|normal|overweight|obese
        $categoryKey = match (true) {
            $bmi < 18.5 => 'underweight',
            $bmi < 25   => 'normal',
            $bmi < 30   => 'overweight',
            default     => 'obese',
        };

        // BMI scale position (0..100)
>>>>>>> fc7673c (frontend update and some new feature)
        if ($bmi < 18.5) {
            $position = (($bmi - 15) / (18.5 - 15)) * 25;
        } elseif ($bmi < 25) {
            $position = 25 + (($bmi - 18.5) / (25 - 18.5)) * 25;
        } elseif ($bmi < 30) {
            $position = 50 + (($bmi - 25) / (30 - 25)) * 25;
        } else {
            $position = 75 + min(($bmi - 30) / 10, 1) * 25;
        }

        $position = max(0, min($position, 100));

<<<<<<< HEAD
        // kategória normalizálása az adatbázishoz
        $dbCategory = strtolower(str_replace(' ', '', $category)); 
        if ($dbCategory === 'normalweight') $dbCategory = 'normal';

        $advice = Advice::where('category', $dbCategory)->first();

        return back()->with([
            'bmi' => round($bmi, 1),
            'category' => $category,
            'bmi_position' => $position,
            'advice' => $advice?->content,
            'old_weight' => $weight,
            'old_height' => $request->input('height')
        ]);
    }
}
=======
        // optional DB lookup (not required for translation)
        $advice = Advice::where('category', $categoryKey)->first();

        return redirect()
            ->route('advice.index')
            ->with([
                'bmi' => $bmiRounded,
                'category_key' => $categoryKey,
                'advice_key' => $categoryKey, // IMPORTANT: matches lang advices keys
                'advice' => $advice?->content, // fallback only
                'bmi_position' => $position,
                'old_weight' => $weight,
                'old_height' => $heightCm,
            ]);
    }
}
>>>>>>> fc7673c (frontend update and some new feature)
