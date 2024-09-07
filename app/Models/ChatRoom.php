<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function chats()
    {
        return $this->hasMany(Chat::class, 'room_id');
    }

    // /**
    //  * このチャットルームに参加しているユーザーを取得します（必要に応じて）。
    //  */
    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'chat_room_user');
    // }
}
