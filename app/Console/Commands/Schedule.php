<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Quote;
use Carbon\Carbon;

class Schedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    public function __cunstruct(){
            parent::__construct();
        }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now(); 
        // $now_format = $now->format('H:i:s');  // ex)21:22:23
            // $hour = 0;
            // $minute = 0;
            // $second = 0;
            // $auto_changequote = Carbon::createFromTime($hour, $minute, $second); 
            // $autoset_format = $auto_changequote->format('H:i:s'); //00:00:00
            $quote = Quote::inRandomOrder()->first();
            return view('home')
        ->with('quote', $quote);
        // ->with('now_format', $now_format)
        // ->with('autoset_format', $autoset_format);

    }
}
