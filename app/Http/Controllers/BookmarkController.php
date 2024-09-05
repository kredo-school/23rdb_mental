<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Bookmark; 


class BookmarkController extends Controller
{
    private $bookmark; 

    public function __construct(Bookmark $bookmark){
        $this->bookmark = $bookmark;
    }

    public function store($quote_id){
        $this->bookmark->user_id = Auth::user()->id;
        $this->bookmark->quote_id = $quote_id;
        $this->bookmark->save();

        return redirect()->back();
    }

    // cancel the bookmark action
    public function destroy($quote_id){
        $this->bookmark
            ->where('user_id', Auth::user()->id)
            ->where('quote_id', $quote_id)
            ->delete();

            return redirect()->back();
    }

    


}
