<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable = ['department_id', 'title', 'discount', 'expires_at'];
}
