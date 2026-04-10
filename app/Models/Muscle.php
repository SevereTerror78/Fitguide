<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Muscle extends Model
{
<<<<<<< HEAD
    protected $fillable = ['name', 'slug'];

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class, 'exercise_muscle');
=======
    protected $fillable = ['name', 'slug', 'category'];

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class);
>>>>>>> fc7673c (frontend update and some new feature)
    }
}
