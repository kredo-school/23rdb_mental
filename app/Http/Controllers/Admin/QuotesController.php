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
        'quote' => 'required|min:1|unique:quotes,quote',
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


public function index(Request $request){
    $all_quotes = $this->quote->withTrashed()->latest()->paginate(10);
    $quotes_count = $this->quote;


    $keyword = $request->input('keyword');
    
  
    // if (!empty($request)){
    //     $all_quotes = Quote::query()
    //         ->where('quote', 'like', '%' . $keyword . '%')
    //         ->orWhere('author', 'like', '%' . $keyword . '%')
    //         ->withTrashed()
    //         ->latest()
    //         ->paginate(3);
    if ($request->search) {

        $all_quotes = $this->quote->where('quote', 'like', '%' . $request->search . '%')
                ->orWhere('author', 'like', '%' . $request->search . '%')
                ->withTrashed()
                ->latest()
                ->paginate(10);
        //search results
        // $all_quotes = Quote::query()
        //         ->where('quote', 'like', '%' . $keyword . '%')
        //         ->orWhere('author', 'like', '%' . $keyword . '%')
        //         ->withTrashed()
        //         ->latest()
        //         ->paginate(3);
        $quotes_count = $all_quotes;
 
         } else {

            $sort = $request->input('sort', 'latest');

            $query = Quote::query();


            if ($sort === 'latest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($sort === 'oldest') {
                $query->orderBy('created_at', 'asc');
            }

            $all_quotes = $query->withTrashed()
            
            ->paginate(10);
            $quotes_count = $all_quotes;
            };
            
            return view('admin.quotes.index')
            ->with('all_quotes', $all_quotes)
            ->with('quotes_count', $quotes_count)
            ->with('search', $request->search)
            ->with('keyword', $keyword);

}





    public function sort(Request $request){
        $sort = $request->input('sort');
        if($sort == 'asc') {
            $all_quotes = $this->quote->withTrashed()->orderBy('created_at', 'asc')->paginate(10);
        }else{
            $all_quotes = $this->quote->withTrashed()->orderBy('created_at', 'asc')->paginate(10);
            $quotes_count = $this->quote;
        
        }
        return view('admin.quotes.index')->with('all_quotes', $all_quotes);

}


/**
 * edit 
 */

 public function update(Request $request, $id){
    $request->validate([
        'quote' => 'required|min:1',
        'author' => 'nullable|max:250',
    ]);
     #save the quote data
     $quote = $this->quote->findOrFail($id);
     $quote->quote = $request->quote;
     $quote->author = $request->author;
     
     $quote->save();
 
     #return
     return redirect()->back();

 }

 /** delete */
 public function destroy($id){
    $quote = $this->quote->findOrFail($id);
    $quote->forceDelete();
    return redirect()->back();
   
 }


/**
 * hide the quote
 */
public function hide($id){
    $this->quote->destroy($id);
    return redirect()->back();
}

/**
 *  unhide the quote 
 */
public function unhide($id){
    $this->quote->withTrashed()->findOrFail($id)->restore();
    return redirect()->back();
}
}
