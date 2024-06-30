<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = ['image'];

    public function scopeSiteImage($query, $image = null)
    {
        if ($image) {
            return url('storage/site_img') . '/' . $image;
        } else {
            // Default favicon URL when no image is provided
            return url('path_to_default_favicon'); // Replace with your default favicon URL
        }
    }
}

