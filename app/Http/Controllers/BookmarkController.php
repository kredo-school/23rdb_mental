<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Bookmark; 
use App\Models\Quote;


class BookmarkController extends Controller
{
    private $bookmark; 
    private $quote;

    public function __construct(Bookmark $bookmark, Quote $quote){
        $this->bookmark = $bookmark;
        $this->quote = $quote;
    }

    public function store($quote_id){
        $this->bookmark->user_id = Auth::user()->id;
        $this->bookmark->quote_id = $quote_id;
        $this->bookmark->save();
        $quote = $this->bookmark->quote_id;

        return redirect()->back();
    }

    // cancel the bookmark action
    public function destroy($quote_id){
        $this->bookmark
            ->where('user_id', Auth::user()->id)
            ->where('quote_id', $quote_id)
            ->delete();
            $quote = $this->bookmark->quote_id;

            return redirect()->back();
    }

    


}
