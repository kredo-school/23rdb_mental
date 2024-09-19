<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;
use App\Models\Bookmark;
use App\Models\User;
use Carbon\Carbon;


class HomeController extends Controller
{

    private $quote;
    private $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Quote $quote, User $user)
    {
        $this->middleware('auth');
        $this->quote = $quote;
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */



    // public function index()
    // {

            // $today = Carbon::today()->timestamp; //today's date is collected
            // $quote = Quote::inRandomOrder($today)->first(); // randamly get a data

//             $today = Carbon::today()->format('Y-m-d');
//             $hash = md5($today);
// $index = hexdec(substr($hash, 0, 8));
// // 格言の総数を取得
// $totalQuotes = Quote::count();
// // ランダムインデックスを計算
// $randomIndex = $index % $totalQuotes;
// $quote = Quote::skip($randomIndex)->first();

            
        // return view('home')
        // ->with('quote', $quote);
        // ->with('now_format', $now_format)
        // ->with('autoset_format', $autoset_format);
    // } 

    // public function change(){
    //     $quote = Quote::inRandomOrder()->select('quote', 'author')->first();
    //     return view('home')
    //     ->with('quote', $quote);


    // }

    public function index(Request $request)
    {
        // セッションから変更された格言を取得、ない場合は新しい格言を取得
        if ($request->session()->has('quote_id')) {
            $quote = Quote::find($request->session()->get('quote_id'));
        } else {
            $quote = $this->getRandomQuote();
            $request->session()->put('quote_id', $quote->id);
        }

        return view('home', compact('quote'));
    }

    public function change(Request $request)
    {
        // 新しいランダムな格言を取得
        $quote = $this->getRandomQuote();
        $request->session()->put('quote_id', $quote->id);

        return redirect()->route('home');
    }

    private function getRandomQuote()
    {
        return Quote::inRandomOrder()->first();
    }

    
}
