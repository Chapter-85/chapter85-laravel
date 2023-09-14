<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'full_name',
        'gender',
        'user_id',
        'occupation',
        'address',
        'country_code',
        'phone_number',
        'business_name',
        'type_of_organization',
        'business_fax',
        'business_email',
        'business_address',
        'city',
        'country',
        'zip_code',
        'retails',
        'type_of_business',
        'business_phone_num',
        'nationality',
        'passport_no',
        'business_reg_num',
        'country_of_incorporation',
        'bank_account_name',
        'bank_account_number',
        'bank_name',
        'bank_branch_number',
        'bank_country_name',
        'bank_swift_code',
        'sales_rep_name',
        'sales_rep_number',
        'sales_rep_country',
        'strorage_service',
        'years_in_business',
        'import',
        'countries_of_import',
        'hear_about_mg'
    ];

    protected $dates = [

        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
        'updated_at' => 'date:d M, Y H:i',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function agent_customers()
    {
        return $this->hasMany(AgentCustomer::class);
    }

    public function customer_products()
    {
        return $this->hasMany(CustomerProduct::class);
    }
}
