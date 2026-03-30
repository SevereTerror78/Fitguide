<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
<<<<<<< HEAD
use App\Models\ProductType;
=======
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
>>>>>>> fc7673c (frontend update and some new feature)
=======
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
>>>>>>> 5c55d34 (new features)

class Product extends Model
{
    use HasFactory;
<<<<<<< HEAD
<<<<<<< HEAD
    protected $fillable = [
        'name', 'description', 'price', 'stock' , 'image', 'product_type_id','is_active',
=======
=======
>>>>>>> 5c55d34 (new features)

    protected $fillable = [
        'name',
        'name_hu',
        'description',
        'description_hu',
        'price_huf',
        'stock',
        'image',
        'product_type_id',
        'is_active',
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
    ];

    public function getPriceFormattedAttribute(): string
    {
<<<<<<< HEAD
<<<<<<< HEAD
        return number_format($this->price, 2, '.', ' ') . ' Ft';
=======
=======
>>>>>>> 5c55d34 (new features)
        $currency = Auth::user()?->currency ?? session('currency', 'HUF');

        if ($currency === 'EUR') {
            $priceEur = round($this->price_huf / 381, 2);
            return '€' . number_format($priceEur, 2, '.', ' ');
        }

        return number_format($this->price_huf, 0, ',', ' ') . ' Ft';
    }

    public function getDisplayPriceAttribute(): float|int
    {
        $currency = Auth::user()?->currency ?? session('currency', 'HUF');

        if ($currency === 'EUR') {
            return round($this->price_huf / 381, 2);
        }

        return $this->price_huf;
    }

    public function getCurrencyCodeAttribute(): string
    {
        return Auth::user()?->currency ?? session('currency', 'HUF');
    }

    public function getCurrencySymbolAttribute(): string
    {
        return $this->currency_code === 'EUR' ? '€' : 'Ft';
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
    }

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return asset('images/placeholder-product.png');
        }
<<<<<<< HEAD
<<<<<<< HEAD
    
        // ha teljes URL van mentve
        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }
    
        $img = ltrim($this->image, '/');
    
        // ha már images/.. van elmentve
        if (str_starts_with($img, 'images/')) {
            return asset($img);
        }
    
        // ha csak fájlnév van elmentve: whey.png
        return asset('images/' . $img);
    }
    
    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }
    
=======
=======
>>>>>>> 5c55d34 (new features)

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        $img = ltrim($this->image, '/');

        if (str_starts_with($img, 'images/')) {
            return asset($img);
        }

        return asset('images/' . $img);
    }

    public function productType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class);
    }

    public function getTranslatedNameAttribute(): string
    {
        $locale = app()->getLocale();

        if ($locale === 'hu' && !empty($this->name_hu)) {
            return $this->name_hu;
        }

        return $this->name;
    }

    public function getTranslatedDescriptionAttribute(): ?string
    {
        $locale = app()->getLocale();

        if ($locale === 'hu' && !empty($this->description_hu)) {
            return $this->description_hu;
        }

        return $this->description;
    }
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
}