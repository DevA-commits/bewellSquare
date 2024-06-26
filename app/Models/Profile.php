<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'image',
        'phone_number',
        'email',
        'designation',
        'website',
        'city',
        'country',
        'zip',
        'description',
    ];

    public function scopeProfileImage($query, $image)
    {
        return url('storage/profile_img') . '/' . $image;
    }
}
