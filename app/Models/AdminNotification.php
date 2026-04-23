<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminNotification extends Model
{
    protected $fillable = [
        'type','title','message',
        'product_id','stock','threshold',
        'read_at'
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }

    public function scopeUnread($q)
    {
        return $q->whereNull('read_at');
    }
}