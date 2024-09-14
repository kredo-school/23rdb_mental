<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Events\MessageSent;
use App\Models\Message;
use App\Models\Chat;
use App\Models\ChatRoom;
use App\Models\User;
use Pusher\Pusher;

class ChatController extends Controller
{
    private $chat;
    private $user;

    public function __construct(Chat $chat, User $user){
        $this->chat = $chat;
        $this->user = $user;
    }

    public function index(Request $request, $room_id)
    {
        $chatRooms = ChatRoom::all();
        $currentRoom = ChatRoom::findOrFail($room_id);
        $chats = $currentRoom->chats();
        $user = Auth::user();

        // if ($request->has('search')) {
        //     $search = $request->input('search');
        //     $chats = $chats->where('body', 'LIKE', "%{$search}%");
        // }
        $chats = $chats->with('chats_include_replying_chat')->get();

        return view('chat.index', compact('chatRooms', 'currentRoom', 'chats', 'user'));
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

            // broadcast(new \App\Events\MessageSent($chat));
            broadcast(new MessageSent($chat))->toOthers();
            \Log::info('test ' . $chat->user->name);

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





    public function reply(Request $request){
        $request->validate([
            'chat_reply' => 'required|min:1|max:1000'
        ]);
        $this->chat->user_id = Auth::user()->id;
        $this->chat->room_id = $request->room_id;
        $this->chat->body = $request->chat_reply;
        $this->chat->replying_chat_id = $request->id;
        $this->chat->save();
        return redirect()->back();
    }

    /**
     * This method is going to perform the actual update
     */
    public function update(Request $request, $id){
        $request->validate([
            'chat_body' => 'required|min:1|max:1000'
        ]);
        $chat = $this->chat->findOrFail($id);
        $chat->body = $request->chat_body;
        $chat->save();
        return redirect()->back();
    }

    /**
     * This method is use to delete a post
     */
    public function destroy($id){
        $chat = $this->chat->findOrFail($id);
        $chat->delete();
        return redirect()->back();
    }

    public function get_replying_chat($id){
        $replying_chat = $this->chat->findOrFail($id);
        return view('chat.chats')
            ->with('replying_chat', $replying_jchat);
    }

    public function update_username(Request $request){

        \Log::info('Update Username method called');

        $request->validate([
            'chat_username' => 'required|min:1|max:1000'
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->username = $request->chat_username;

        \Log::info('username(request ' . $request->chat_username);
        \Log::info('username(user ' . $user->username);


        $user->save();
        return redirect()->back();
    }




 

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