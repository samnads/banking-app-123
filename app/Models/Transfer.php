<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_user_id');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_user_id');
    }
}
