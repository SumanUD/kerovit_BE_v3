<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $table = 'career'; 
    protected $fillable = [
        'banner_image',
        'banner_text',
        'below_banner_description',
        'center_image',
        'application_email',
    ];
}
