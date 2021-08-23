<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleRecord extends Model
{
    protected $fillable = [
        'department_id',
        'product_variation_id',
        'product_title',
        'product_variation_title',
        'type_title',
        'quantity',
        'unit_of_quantity',
    ];
}
