<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'collection_id',
        'name',
        'slug',
        'description',
        'thumbnail_image',
        'is_active',
        'order'
    ];

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    public function ranges()
    {
        return $this->hasMany(Range::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'category_name', 'id');
    }

}