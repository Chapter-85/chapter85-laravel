<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class WalkInCustomer extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'zip_code',
        'city',
        'state',
        'country',
        'address'
    ];

    protected $dates = [

        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
        'updated_at' => 'date:d M, Y H:i',
    ];

    public function customer_products()
    {
        return $this->hasMany(CustomerProduct::class);
    }
}
