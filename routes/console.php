<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// $today_quote->command('handle')
// ->everySecond();
// })->daily();

// protected function schedule(today_quote $today_quote)
// {
//     $today_quote->command('')->everyMinute(); // 毎分実行されます
// }

// public function schedule(Schedule $schedule){
//         $schedule->call(function() {
//             $quiz = Quiz::with('answer')
//             ->inRandomOrder()
//             ->get();
//             return $quiz;
//         })
//         ->everyMinute();

//     }

    