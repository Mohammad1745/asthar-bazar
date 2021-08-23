<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_code',
        'first_name',
        'last_name',
        'email',
        'phone_code',
        'phone',
        'address',
        'zip_code',
        'city',
        'country',
        'quantity',
        'subtotal',
        'total_weight',
        'charges',
        'total_price',
        'paid',
        'payment_method',
        'shipping_method',
        'payment_status',
        'shipping_status'
    ];
}
