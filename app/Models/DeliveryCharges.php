<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryCharges extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'amount',
        'delivery_method',
        'time_duration',
        'grace_period',
        'charge_at_beginning',
    ];

    protected $dates = [

        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
    ];

    public function category()
    {
        return $this->belongsTo(Catergory::class, 'category_id', 'id');
    }
}
