<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title2',
        'description',
        'description2',
        'describe_one',
        'describe_two',
        'describe_three',
        'image',
        'image2',
        'image3',
    ];

    public function scopeFeatureImageOne($query, $image)
    {
        return url('storage/feature_img_one') . '/' . $image;
    }

    public function scopeFeatureImageTwo($query, $image)
    {
        return url('storage/feature_img_two') . '/' . $image;
    }

    public function scopeFeatureImageThree($query, $image)
    {
        return url('storage/feature_img_three') . '/' . $image;
    }
}
