<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    public function product()
    {
        return $this->belongsTo(ProductType::class);
    }
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> 5c55d34 (new features)
    public function getTranslatedNameAttribute(): string
    {
        $locale = app()->getLocale();

        if ($locale === 'hu' && $this->name_hu) {
            return $this->name_hu;
        }

        return $this->name;
    }
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
}
