<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductType extends Model
{
    protected $fillable = [
        'name',
        'name_hu',
        'slug',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
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