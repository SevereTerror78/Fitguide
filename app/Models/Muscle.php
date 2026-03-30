<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Muscle extends Model
{
<<<<<<< HEAD
<<<<<<< HEAD
    protected $fillable = ['name', 'slug'];

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class, 'exercise_muscle');
=======
=======
>>>>>>> 5c55d34 (new features)
    protected $fillable = ['name', 'slug', 'category'];

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class);
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
    }
}
