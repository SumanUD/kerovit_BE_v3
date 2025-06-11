<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogue extends Model
{
       protected $fillable = [
        'banner_image',
        'description',
        'catalogue_image_1',
        'catalogue_image_2',
        'catalogue_pdf_1',
        'catalogue_pdf_2',
    ];
}
