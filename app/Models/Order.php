<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
        'company_name',
        'company_address',
        'company_mobile',
        'representer_name',
        'representer_mobile',
        'designer_id',
        'printer_id',
        'services',
        'state',
        'items',
        'payment_method',
        'total_price',
        'amount_paid',
        'discount',
        'amount_due',
        'remarks',
    ];
    protected $casts = [
        'services' => 'array',
        'items' => 'array',
    ];


    use HasFactory;
}
