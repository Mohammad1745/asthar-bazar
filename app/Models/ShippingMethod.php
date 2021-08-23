<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    protected $fillable = ['title', 'logo', 'extra_charge', 'description', 'status'];
}
