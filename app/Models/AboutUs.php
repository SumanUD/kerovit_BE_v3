<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class AboutUs extends Model
{
    use HasFactory;

    protected $table = 'about_us'; // Specify the table name if it differs from the model name

    // Define fillable fields for mass assignment
        protected $fillable = [
        'banner_image',
        'banner_description',
        'below_banner_content',
        'director_image',
        'director_description',
        'manufacturing',
        'certification_images',
    ];

    protected $casts = [
        'manufacturing' => 'array',
        'certification_images' => 'array',
    ];
}
