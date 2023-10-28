<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSizes extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $dates = [

        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
        'updated_at' => 'date:d M, Y H:i',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function product_quantity()
    {
        $inventory = Inventory::where('product_size_id', $this->id)->sum('units');
        if ($inventory > 0) {
            // dd($inventory);
            return $inventory;
        }
        return null;
    }
}
