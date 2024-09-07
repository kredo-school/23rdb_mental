<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\Chat;
use App\Models\ChatRoom;
use Illuminate\Http\Request;
use Pusher\Pusher;

class ChatController extends Controller
{
    public function index($room_id)
    {
        $chatRooms = ChatRoom::all();
        $currentRoom = ChatRoom::findOrFail($room_id);
        $chats = $currentRoom->chats()->get();
        return view('chat.index', compact('chatRooms', 'currentRoom', 'chats'));
    }//Index

    public function store(Request $request, $room_id)
    {
        // try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',  // `user_id` が `users` テーブルに存在するか確認
                'body' => 'required|string|max:500',
            ]);

            $chat = Chat::create([
                'room_id' => $room_id,
                'user_id' => $validated['user_id'],
                'body' => $validated['body'],
            ]);
            // dd($chat);

            // Pusherでリアルタイム送信
            $pusher = new Pusher(
                config('broadcasting.connections.pusher.key'),
                config('broadcasting.connections.pusher.secret'),
                config('broadcasting.connections.pusher.app_id'),
                ['cluster' => config('broadcasting.connections.pusher.options.cluster')]
            );

            $pusher->trigger('chat-room-' . $room_id, 'new-message', [
                'username' => $chat->user->name,  // 外部キーの `user_id` からユーザー名を取得
                'message' => $chat->body,
            ]);

            broadcast(new \App\Events\MessageSent($chat));

            // return response()->json(['status' => 'Message sent successfully!']);
            return redirect()->route('chat.chats', $room_id);
            // return response()->json(['status' => 'Message sent successfully!', 'chat' => $chat]);

            //code...
        // } catch (\Throwable $th) {
        //     \Log::error('Error in ChatController store method: ' . $th->getMessage());
        //     \Log::info('Request data:', $request->all());
        //     return response()->json(['error' => 'An error occurred'], 500);
        // }
    }//Store


    public function sendMessage(Request $request)
    {
        try{
            $chat = Chat::create([
                'user_id' => auth()->id(),
                'chat_room_id' => $request->chat_room_id,
                'body' => $request->message,
            ]);

            $pusher = new Pusher(
                config('broadcasting.connections.pusher.key'),
                config('broadcasting.connections.pusher.secret'),
                config('broadcasting.connections.pusher.app_id'),
                ['cluster' => config('broadcasting.connections.pusher.options.cluster')]
            );

            $pusher->trigger('chat', 'message-sent', $chat);

            // return response()->json(['status' => 'Message sent successfully!']);
            return redirect()->route('chat.chats', $room_id);
            // return response()->json(['status' => 'Message sent successfully!']);

        }catch (\Throwable $th) {
            Log::error('Error in ChatController sendMessage method: ' . $th->getMessage());
            return response()->json(['error' => 'An error occurred.'], 500);
        }

    }//sendMessage

}//End of Controller



    // public function index($room)
    // {
    //     $chatRoom = ChatRoom::where('name', $room)->firstOrFail();
    //     // $messages = Message::where('room_id', $chatRoom->id)->get();
    //     $messages = $chatRoom->messages()->with('user')->latest()->get();  //which?

    //     return view('chat.index', compact('chatRoom', 'messages'));
    // }

    // public function sendMessage(Request $request, $room)
    // {
    //     $chatRoom = ChatRoom::where('name', $room)->firstOrFail();

    //         // バリデーション（必要に応じて追加）
    //     // $request->validate([
    //     //     'message' => 'required|string|max:1000',
    //     // ]);

    //     $message = new Message();
    //     $message->room_id = $chatRoom->id;
    //     $message->user_id = auth()->id();
    //     $message->content = $request->message;
    //     $message->save();

    //     // メッセージの作成
    //     $message = $chatRoom->messages()->create([
    //         'user_id' => auth()->id(),
    //         'content' => $request->message,
    //     ]);



    //     broadcast(new MessageSent($message))->toOthers();

    //     return response()->json(['status' => 'Message Sent!']);
    // }
// }