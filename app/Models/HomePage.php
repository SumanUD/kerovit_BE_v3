<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    use HasFactory;

    protected $table = 'home_page'; // Specify the table name if it differs from the model name

    // Define fillable fields for mass assignment
    protected $fillable = [
        'banner_type',
        'video_url',
        'slider_images',
        'categories_text',
        'aurum_text',
        'klassic_text',
        'world_of_kerovit_text',
        'world_of_kerovit_button_text',
        'world_of_kerovit_button_url',
        'world_of_kerovit_image',
        'catalogue_pdf_1',
        'catalogue_pdf_2',
        'about_us_text',
        'about_us_image',
        'about_us_button_text',
        'about_us_button_url',
    ];

    // Cast JSON columns for proper handling
    protected $casts = [
        'slider_images' => 'array', // Cast slider_images to an array
    ];
}
