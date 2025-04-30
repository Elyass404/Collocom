<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportMessage extends Model
{
    protected $primaryKey = 'message_id';
    
    protected $fillable = [
        "user_id",
        "name",
        "message_content",
        "email",
        "phone_number",
        "object",
        "status",

    ];
}
