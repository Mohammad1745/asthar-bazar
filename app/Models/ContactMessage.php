<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = ['user_id', 'to', 'message', 'read', 'replied_by', 'reply'];
}
