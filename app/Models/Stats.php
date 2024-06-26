<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stats extends Model
{
    use HasFactory;

    protected $fillable = [
        'experience',
        'projects',
        'repeat_customer',
        'client_satisfaction',
        'worker',
        'image',
    ];

    public function scopeStatsImage($query, $image)
    {
        return url('storage/stats_img') . '/' . $image;
    }
}
