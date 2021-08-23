<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminSettings extends Model
{
    protected $fillable = ['user_id', 'slug', 'value'];
}
