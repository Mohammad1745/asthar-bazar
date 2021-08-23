<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollectionItem extends Model
{
    protected $fillable = ['collection_id', 'product_variation_id', 'discount', 'expires_at'];
}
