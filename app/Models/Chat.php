<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['room_id', 'user_id', 'body', 'replying_chat_id'];

    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function chatRoom()
    {
        return $this->belongsTo(ChatRoom::class, 'room_id');
    }
    
    public function chats_include_replying_chat(){
        return $this->belongsTo(Chat::class, 'replying_chat_id');
    }

}
