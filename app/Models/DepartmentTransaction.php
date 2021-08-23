<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentTransaction extends Model
{
    protected $fillable = ['department_id', 'revenue', 'revenue_from_wallet', 'manufacturing_cost', 'profit', 'loss_on_discount', 'customer_reward', 'net_profit', 'status'];
}
