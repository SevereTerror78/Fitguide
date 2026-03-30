<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductType;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'price', 'stock' , 'image', 'product_type_id','is_active',
    ];

    public function getPriceFormattedAttribute(): string
    {
        return number_format($this->price, 2, '.', ' ') . ' Ft';
    }

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return asset('images/placeholder-product.png');
        }
    
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
    
}