<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPictures extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image',
    ];
    protected $appends = [
        'product_picture_url',
    ];
    public function getProductPictureUrlAttribute()
    {
        $image = asset('frontend/images/shop/product-placeholder.jpg');

        if (!empty($this->image) && file_exists('uploads/products/' . $this->image)) {
            $image = asset('uploads/products/' . $this->image);
        }

        return $image;
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
