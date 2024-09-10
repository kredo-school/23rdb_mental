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

    public function index(Request $request){
        $chats_query = $this->chat->with('chats_include_replying_chat');
        // Sort
        $sort = $request->input('sort', 'name');
        if ($sort === 'hidden') {
        $chats_query->orderBy('deleted_at', 'desc');
        } elseif ($sort === 'oldest') {
            $chats_query->orderBy('created_at');
        } elseif ($sort === 'Latest') {
            $chats_query->orderBy('created_at', 'desc');
        } else {
            $chats_query->orderBy('created_at', 'desc');
        }
        // Search
        if ($request->search_date_start) {
            $chats_query = $chats_query
                ->whereDate('created_at', '>=', $request->search_date_start);
        }
        if ($request->search_date_end) {
            $chats_query = $chats_query
                ->whereDate('created_at', '<=', $request->search_date_end);
        }
        if ($request->search) {
            $chats_query = $chats_query
                ->where('body', 'LIKE', '%' . $request->search . '%');
        }
        $chatroom = $request->input('chatroom', 'name');
        if ($chatroom === 'all' || $chatroom === 'name') {
            $chats_query = $chats_query;
        } else {
            $chats_query = $chats_query->where('room_id', $chatroom);
        }

        // Return
        $chats_count = $chats_query->withTrashed()->get()->count();
        $all_chats = $chats_query->withTrashed()->paginate(10)
        ->appends([
            'search' => $request->search,
            'sort' => $sort,
            'search_date_start' => $request->search_date_start,
            'search_date_end' => $request->search_date_end,
            'chatroom' => $chatroom,
        ]);

        return view('admin.chats.index')
            ->with('all_chats', $all_chats)
            ->with('search_date_start', $request->search_date_start)
            ->with('search_date_end', $request->search_date_end)
            ->with('search', $request->search)
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

    public function hide($id){
        $this->chat->destroy($id);
        return redirect()->back();
    }

    public function unhide($id){
        $this->chat->withTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }
}
