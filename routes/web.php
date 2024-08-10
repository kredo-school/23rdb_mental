<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\MoodController;
use Illuminate\Support\Facades\Route;

// admin
use App\Http\Controllers\Admin\QuotesController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/setting', [ProfileController::class, 'setting'])->name('profile.setting');

    // MOOD
    Route::get('/mood/create1', [MoodController::class, 'create1'])->name('mood.save1');
    Route::get('/mood/create', [MoodController::class, 'create'])->name('mood.create');
});


require __DIR__.'/auth.php';

// Test Page
Route::get('/test', [TestController::class, 'index']);


//admin route


    //quotes
    Route::get('/quote', [QuotesController::class, 'index'])->name('quote.index');


// Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' =>'admin'], function(){

//     //quotes
//     Route::get('/admin/quote', [QuotesController::class, 'index'])->name('quote'); // admin.quote
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
