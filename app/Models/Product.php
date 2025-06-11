<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Range;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'product_id';

    public $timestamps = false;

    protected $fillable = [
        'product_code',
        'thumbnail_picture',
        'product_title',
        'Series', // Series is Range
        'shape',
        'spray',
        'ranges',
        'collection',
        'product_description',
        'size',
        'price',
        'product_image',
        'diagram_image_name',
        'additional_image1',
        'additional_image2',
        'additional_image3',
        'additional_image4',
        'additional_image5',
        'installation_service_parts',
        'feature_image',
        'additional_information',
        'category_name'
    ];

    protected $casts = [
        'price' => 'float',
    ];

    public function getProductImageUrlAttribute()
    {
        return asset('storage/products/' . $this->product_image);
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection','id');
    }
    public function ranges()
    {
        return $this->belongsTo(Range::class, 'ranges','id');
    }

    public function range()
{
    return $this->belongsTo(Range::class, 'ranges', 'id');
}

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_name','id');
    }

}
