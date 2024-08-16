<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\MoodController;
use App\Http\Controllers\BookmarkController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\JournalController;

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
    Route::get('/profile/{id}/show', [ProfileController::class, 'show'])->name('profile.show');

    // MOOD
    Route::get('/mood/create1', [MoodController::class, 'create1'])->name('mood.save1');
    Route::get('/mood/create', [MoodController::class, 'create'])->name('mood.create');
});


require __DIR__.'/auth.php';

// Test Page
Route::get('/test', [TestController::class, 'index']);
Route::get('/test/navbar', function () {
    return view('test.navbar');
});


//admin route


    //quotes
    // Route::get('/quote', [QuotesController::class, 'index'])->name('quote.index');

    Route::get('/quote', [QuotesController::class, 'index'])->name('quote.index');
    Route::post('/quote/store',[QuotesController::class, 'store'])->name('quote.store');
    

// Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' =>'admin'], function(){

//     //quotes
//     Route::get('/admin/quote', [QuotesController::class, 'index'])->name('quote'); // admin.quote
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


/** 
 * routes related to bookmarks
 */
Route::post('/bookmark/{bookmark_id}/store', [BookmarkController::class, 'store'])->name('bookmark.store');
Route::delete('/bookmark/{bookmark_id}/destroy', [BookmarkController::class, 'destroy'])->name('bookmark.destroy');

// journal
Route::get('/journals', [JournalController::class, 'index'])->name('journal.journals');
Route::get('/journal/search', [JournalController::class, 'search'])->name('journal.search');
Route::post('/journal/store', [JournalController::class, 'store'])->name('journal.store');
Route::patch('/journal/{id}/update', [JournalController::class, 'update'])->name('journal.update');
Route::patch('/journal/{id}/update_like', [JournalController::class, 'update_like'])->name('journal.update_like');
Route::patch('/journal/{id}/reply', [JournalController::class, 'reply'])->name('journal.reply');
Route::delete('/journal/{id}/destroy', [JournalController::class, 'destroy'])->name('journal.destroy');
