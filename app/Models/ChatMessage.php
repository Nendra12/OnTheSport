<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = [
        "sender_id", "receiver_id", "message",
        "file_path", "file_name", "file_type", "file_size"
    ];


    public function sender () 
    {
        return $this->belongsTo(User::class, "sender_id");
    }
    public function receiver () 
    {
        return $this->belongsTo(User::class, "receiver_id");
    }
}
