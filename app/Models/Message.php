<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['room_id', 'user_id', 'body'];

    /**
     * メッセージが属するチャットルームを取得します。
     */
    public function chatRoom()
    {
        return $this->belongsTo(ChatRoom::class);
    }

    /**
     * メッセージを送信したユーザーを取得します。
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
