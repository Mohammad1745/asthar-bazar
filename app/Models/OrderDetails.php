<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $fillable = [
        'order_id',
        'product_title',
        'product_variation_id',
        'product_variation_title',
        'type_title',
        'department_title',
        'description',
        'unit_price',
        'weight_per_unit',
        'unit_of_quantity',
        'quantity',
        'price',
        'weight'
    ];
}
