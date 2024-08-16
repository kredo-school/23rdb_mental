<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Journal;
use App\Models\Reply;

class JournalController extends Controller
{
    private $journal;
    private $reply;

    public function __construct(Journal $journal, Reply $reply){
        $this->journal = $journal;
        $this->reply = $reply;
    }

    public function index(){
        $all_journals = $this->journal->paginate(7);
        return view('journals.index')->with('all_journals', $all_journals);
        # SELECT * FROM journals ORDER BY CREATED_AT DESC;  ->latest()
    }

    public function search(Request $request){
        $journals = $this->journal->where('body', 'like', '%' . $request->search . '%')->get();
        return view('journals.search')->with('journals', $journals)->with('search', $request->search);
    }

    public function store(Request $request){
        $request->validate([
            'journal_body' => 'required|min:1|max:1000'
        ]);
        $this->journal->user_id = '1';//Auth::user()->id;
        $this->journal->body = $request->journal_body;
        $this->journal->save();
        return redirect()->back();
    }

    /**
     * This method is going to perform the actual update
     */
    public function update(Request $request, $id){
        $request->validate([
            'journal_body' => 'required|min:1|max:1000'
        ]);
        $journal = $this->journal->findOrFail($id);
        $journal->body = $request->journal_body;
        $journal->save();
        return redirect()->back();
    }

    public function update_like(Request $request, $id){
        $journal = $this->journal->findOrFail($id);
        $journal->like_score = $request->input('likeScore' . $id);
        $journal->save();
        return redirect()->back();
    }
    
    public function reply(Request $request, $journal_id){
        $request->validate([
            'journal_reply' => 'required|min:1|max:1000'
        ]);
        $this->reply->journal_id = $journal_id;
        $this->reply->body = $request->journal_reply;
        $this->reply->save();
        return redirect()->back();
    }

    /**
     * This method is use to delete a post
     */
    public function destroy($id){
        $journal = $this->journal->findOrFail($id);
        $journal->delete(); //delete entirely
        return redirect()->back();
    }
}
