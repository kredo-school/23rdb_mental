<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Chat;

class ChatroomController extends Controller
{
    private $chat;

    public function __construct(Chat $chat){
        $this->chat = $chat;
    }

    public function index(){
        $all_chats = $this->chat->where('user_id', Auth::user()->id)->get();
        return view('chatroom.index')->with('all_chats', $all_chats);
    }

    public function search(Request $request){
        $chats = $this->chat->where('user_id', Auth::user()->id)->where('body', 'like', '%' . $request->search . '%')->get();
        return view('chatroom.search')->with('chats', $chats)->with('search', $request->search);
    }

    public function store(Request $request){
        $request->validate([
            'chat_body' => 'required|min:1|max:1000'
        ]);
        $this->chat->user_id = Auth::user()->id;
        $this->chat->body = $request->chat_body;
        $this->chat->save();
        return redirect()->back();
    }

    public function update(Request $request, $id){
        $request->validate([
            'chat_body' => 'required|min:1|max:1000'
        ]);
        $chat = $this->chat->findOrFail($id);
        $chat->body = $request->chat_body;
        $chat->save();
        return redirect()->back();
    }

    public function destroy($id){
        $chat = $this->chat->findOrFail($id);
        $chat->delete();
        return redirect()->back();
    }
}
