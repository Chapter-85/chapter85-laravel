<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catergory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'name_s_ch',
        'name_t_ch',
        'abbreviation',
        'parent_id',
        'surcharge_at_category',
        'markup_type',
        'mark_up',
        'picture'
    ];
    protected $dates = [

        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
    ];

    protected $appends = [
        'picture_url',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function parent()
    {
        return $this->belongsTo(Catergory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Catergory::class, 'parent_id');
    }

    public function deliver_charges()
    {
        return $this->hasOne(DeliveryCharges::class);
    }

    public function getPictureUrlAttribute()
    {
        $image = asset('frontend/images/shop/product-placeholder.jpg');

        if (!empty($this->picture) && file_exists('uploads/products/' . $this->picture)) {
            $image = asset('uploads/categories/' . $this->picture);
        }

        return $image;
    }
}
