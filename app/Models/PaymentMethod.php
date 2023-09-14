<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_method',
        'due_date',
        'due_date_type',
        'payment_method_s_ch',
        'payment_method_ch',
        'description',
        'description_s_ch',
        'description_ch',
        'email_instructions'
    ];

    protected $dates = [

        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
    ];
}
