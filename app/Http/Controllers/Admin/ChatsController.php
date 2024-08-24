<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chat;

class ChatsController extends Controller
{
    private $chat;

    public function __construct(Chat $chat){
        $this->chat = $chat;
    }

    public function index(){
        $all_chats = $this->chat->withTrashed()->latest()->paginate(10);
        $chats_count = $this->chat;

        return view('admin.chats.index')
        ->with('all_chats', $all_chats)
        ->with('chats_count', $chats_count);
    }

    public function search(Request $request){
        $chats = $this->chat->where('body', 'like', '%' . $request->search . '%')->get();
        return view('admin.chats.search')->with('chats', $chats)->with('search', $request->search);
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
