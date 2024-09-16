<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Journal;
use App\Models\JournalComment;
use Carbon\Carbon;

class JournalController extends Controller
{
    private $journal;
    private $journal_comment;

    public function __construct(Journal $journal, JournalComment $journal_comment){
        $this->journal = $journal;
        $this->journal_comment = $journal_comment;
    }

    public function index(Request $request){
        $journals_query = $this->journal->with('journals_include_replying_journal');
        $journals_query = $journals_query
            ->where('user_id', Auth::user()->id);
        // Sort
        $sort = $request->input('sort', 'name');
        if ($sort === 'date') {
            $journals_query->orderBy('created_at');
        } elseif ($sort === 'like_score') {
            $journals_query->orderBy('like_score', 'desc');
        } else {
            $journals_query->orderBy('created_at', 'desc');
        }
        // Search
        if ($request->search) {
            $journals_query = $journals_query
                ->where('body', 'LIKE', '%' . $request->search . '%');
        }
        if ($request->search_date_start) {
            $journals_query = $journals_query
                ->whereDate('created_at', '>=', $request->search_date_start);
        }
        if ($request->search_date_end) {
            $journals_query = $journals_query
                ->whereDate('created_at', '<=', $request->search_date_end);
        }
        $all_journals = $journals_query->paginate(10);
        return view('journals.index')
            ->with('all_journals', $all_journals)
            ->with('search_date_start', $request->search_date_start)
            ->with('search_date_end', $request->search_date_end)
            ->with('search', $request->search);
    }

    // public function search(Request $request){
    //     $journals = $this->journal->where('user_id', Auth::user()->id)->where('body', 'like', '%' . $request->search . '%')->get();
    //     return view('journals.search')->with('journals', $journals)->with('search', $request->search);
    // }

    public function store(Request $request){
        $request->validate([
            'journal_body' => 'required|min:1|max:1000'
        ]);
        $this->journal->user_id = Auth::user()->id;
        $this->journal->body = $request->journal_body;
        $this->journal->save();
        return redirect()->back();
    }

    public function reply(Request $request){
        $request->validate([
            'journal_reply' => 'required|min:1|max:1000'
        ]);
        $this->journal->user_id = Auth::user()->id;
        $this->journal->body = $request->journal_reply;
        $this->journal->replying_journal_id = $request->id;
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

    /**
     * This method is use to delete a post
     */
    public function destroy($id){
        $journal = $this->journal->findOrFail($id);
        $journal->delete();
        return redirect()->back();
    }

    // public function update_like(Request $request, $id){
    //     $journal = $this->journal->findOrFail($id);
    //     $journal->like_score = $request->input('likeScore' . $id);
    //     $journal->save();
    //     return redirect()->back();
    // }

    public function get_replying_journal($id){
        $replying_journal = $this->journal->findOrFail($id);
        return view('journals.index')
            ->with('replying_journal', $replying_journal);
    }

    public function incrementLikeScore($id)
    {
        $journal = $this->journal->findOrFail($id);
        $journal->incrementLikeScore();
        return response()->json(['like_score' => $journal->like_score]);
    }

    public function decrementLikeScore($id)
    {
        $journal = $this->journal->findOrFail($id);
        $journal->decrementLikeScore();
        return response()->json(['like_score' => $journal->like_score]);
    }
    
    public function comment(Request $request, $journal_id){
        $request->validate([
            'journal_comment' => 'required|min:1|max:1000'
        ]);
        $this->journal_comment->journal_id = $journal_id;
        $this->journal_comment->body = $request->journal_comment;
        $this->journal_comment->created_at = Carbon::now();
        $this->journal_comment->updated_at = Carbon::now();
        $this->journal_comment->save();
        
        return redirect()->back();
    }


    // public function like_plus_one(Request $request){
    //     Log::debug($request->journal_id);
    //     $journal = $this->journal->findOrFail($request->journal_id);
    //     $journal->like_score += 1;
    //     $journal->save();
        
    //     $likes_count = $journal->like_score();
    //     $params = [ 'likes_count' => $likes_count ];

    //     // return redirect()->back();
    //     return response()->json($params);
    // }



}
