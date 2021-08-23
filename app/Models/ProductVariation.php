<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    protected $fillable = [
        'product_id',
        'type_id',
        'title',
        'description',
        'image',
        'quantity',
        'unit_of_quantity',
        'weight_per_unit',
        'manufacturing_cost',
        'regular_price',
        'unit_price',
        'status',
        'available_at'
    ];
}
