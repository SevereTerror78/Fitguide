<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    public function product()
    {
        return $this->belongsTo(ProductType::class);
    }
    public function getTranslatedNameAttribute(): string
    {
        $locale = app()->getLocale();

        if ($locale === 'hu' && $this->name_hu) {
            return $this->name_hu;
        }

        return $this->name;
    }
}
