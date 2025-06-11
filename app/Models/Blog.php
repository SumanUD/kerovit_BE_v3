<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner_image', 'short_description', 'long_description', 'gallery'
    ];

    protected $casts = [
        'gallery' => 'array'
    ];
}
