<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $fillable = ['image', 'description', 'title'];

    public function scopeBannerImage($query, $image)
    {
        return url('storage/banner_img') . '/' . $image;
    }
}
