<?php

namespace App\Events;

use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chat;

    /**
     * Create a new event instance.
     */
    public function __construct(Chat $chat)
    {
        $this->chat = $chat;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel
     */
    public function broadcastOn()
    {
        // return new Channel('chat');
        // return new PresenceChannel('chat.' . $this->message->room_id);
        return new Channel('chat-room-' . $this->message->room_id);
    }

    /**
     * ブロードキャストされるデータを設定
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'user' => [
                'id' => $this->chat->user->id,
                'avatar' => $this->chat->user->avatar,
                'name' => $this->chat->user->name,
            ],
            'message' => $this->chat->body,
            'created_at' => $this->chat->created_at->toDateTimeString(),
        ];
    }
}
