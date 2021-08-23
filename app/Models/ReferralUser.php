<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralUser extends Model
{
    protected $fillable = ['parent_id', 'child_id'];
}
