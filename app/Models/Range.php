<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Range extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'collection_id',
        'name',
        'slug',
        'description',
        'thumbnail_image',
        'is_active',
        'order'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function productsid()
    {
        return $this->hasMany(Product::class, 'ranges', 'id');
    }
}