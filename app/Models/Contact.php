<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'phone1',
        'phone2',
        'email1',
        'email2',
        'opening_time',
        'closing_time',
        'opening_day',
        'closing_day',
    ];
}
