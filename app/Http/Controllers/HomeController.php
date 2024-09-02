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

    //     $now = Carbon::now(); 
    //     $now_format = $now->format('H:i:s');  // ex)21:22:23
    //         $hour = 0;
    //         $minute = 0;
    //         $second = 0;
    //         $auto_changequote = Carbon::createFromTime($hour, $minute, $second); 
    //         $autoset_format = $auto_changequote->format('H:i:s'); //00:00:00

    //         do{
    //         $today_quote = Quote::inRandomOrder()->select('quote', 'author')->first();
    //         }while ($now == $autoset_format);
            
    //     return view('home')
    //     ->with('today_quote', $today_quote)
    //     ->with('now_format', $now_format)
    //     ->with('autoset_format', $autoset_format);
    // } 


    // try1 

    public function index()
    {

        // $now = Carbon::now(); 
        // $now_format = $now->format('H:i:s');  // ex)21:22:23
        //     $hour = 0;
        //     $minute = 0;
        //     $second = 0;
        //     $auto_changequote = Carbon::createFromTime($hour, $minute, $second); 
        //     $autoset_format = $auto_changequote->format('H:i:s'); //00:00:00

        //     do{
        //     $quote = Quote::inRandomOrder()->first();
        //     }while ($now == $autoset_format);
            
            $today = Carbon::today()->timestamp;

            $quote = Quote::inRandomOrder($today)->first();


            
        return view('home')
        ->with('quote', $quote);
        // ->with('now_format', $now_format)
        // ->with('autoset_format', $autoset_format);
    } 

    // public function change(){
    //     $quote = Quote::inRandomOrder()->select('quote', 'author')->first();
    //     return view('home')
    //     ->with('quote', $quote);


    // }

    public function change(Request $request) {
        // if ($request->has('change')) {
            $quote = Quote::inRandomOrder()->first();
            return view('home')
             ->with('quote', $quote);


        }

    
}
