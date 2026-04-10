<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = ['name', 'description', 'video_url'];

    public function muscles()
    {
<<<<<<< HEAD
        return $this->belongsToMany(Muscle::class, 'exercise_muscle');
    }
}
=======
        return $this->belongsToMany(Muscle::class);
    }
}
>>>>>>> fc7673c (frontend update and some new feature)
