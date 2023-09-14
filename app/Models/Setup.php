<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setup extends Model
{
    use HasFactory;

    protected $fillable = [
        'delivery_method',
        'due_date',
        'due_date_type',
        'delivery_method_s_ch',
        'delivery_method_ch',
        'description',
        'description_s_ch',
        'description_ch',
    ];

    protected $dates = [

        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
    ];
}
