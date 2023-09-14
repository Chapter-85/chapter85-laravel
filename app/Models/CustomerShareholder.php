<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerShareholder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'customer_id',
        'title',
        'email',
        'phone_number',
        'passport_no',
        'nationality',
        'address'
    ];
    protected $dates = [

        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
