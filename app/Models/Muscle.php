<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Muscle extends Model
{
    protected $fillable = ['name', 'slug', 'category'];

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class);
    }
}
