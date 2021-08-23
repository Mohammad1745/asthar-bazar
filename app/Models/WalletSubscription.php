<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletSubscription extends Model
{
    protected $fillable = ['package', 'charge', 'capacity'];
}
