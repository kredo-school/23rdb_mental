<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Quote;

class QuotesController extends Controller
{
    private $quote;

    public function __construct(Quote $quote){
        $this->quote = $quote;
    }

    // show all quotes

    
        // public function index() {
        //     return view('admin.quotes.index');
        // }
    //     public function index() {
    //     $all_quotes = $this->quote->latest()->get();
    //     return view('admin.quotes.index')->with('all_quotes', $all_quotes);
    // }

 // create new quote
 public function store(Request $request){
    #validate
    $request->validate([
        'quote' => 'required|min:1',
        'author' => 'nullable|max:250',
    ]);

    #save the quote data
    $this->quote->quote = $request->quote;
    $this->quote->author = $request->author;
    $this->quote->user_id = Auth::user()->id; //creater
    $this->quote->save();

    #return
    return redirect()->route('quote.index');
}

    // show all quotes
    public function index(){
        // if ($request->search){
        //     $search_result = $this->post->where('quote', 'LIKE', '%' . $request->search . '%')->latest()->get();
        // }else{
            // $quote_id = Auth::user()->quote->id;
            $all_quotes = $this->quote->withTrashed()->latest()->paginate(10);
            $quotes_count = $this->quote;
            // $this->quote->id = $quote_id;
            
        // }

        return view('admin.quotes.index')
            ->with('all_quotes', $all_quotes)
            ->with('quotes_count', $quotes_count);
            // ->with('search', $request->search);

            // $userId = auth()->id(); 
            // $quote_id = Quote::where('user_id', $userId)->withTrashed()->latest()->paginate(3);

            // return view('admin.quotes.index', compact('quote_id'))
    }

  
   



    //edit a quote

    //hide a quote

    //delete a quote
}
