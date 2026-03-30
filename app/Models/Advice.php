<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advice extends Model
{
    use HasFactory;

    protected $table = 'advices'; 

    protected $fillable = [
        'user_id',
        'category',
<<<<<<< HEAD
        'content',
=======
>>>>>>> 5c55d34 (new features)
    ];
}
