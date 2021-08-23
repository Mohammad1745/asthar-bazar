<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWallet extends Model
{
    protected $fillable = ['user_id', 'wallet_subscription_id', 'amount', 'capacity', 'expires_at'];
}
