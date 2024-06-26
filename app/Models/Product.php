<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'image',
    ];

    public function scopeProductImage($query, $image)
    {
        return url('storage/product_img') . '/' . $image;
    }
}
