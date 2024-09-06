<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\MoodController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\InquiryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\ChatroomController;
use App\Http\Controllers\MessagesController;

// admin
use App\Http\Controllers\Admin\QuotesController;
use App\Http\Controllers\Admin\InquiriesController;
use App\Http\Controllers\Admin\ChatsController;
use App\Http\Controllers\Admin\DeletionReasonController;
use App\Http\Controllers\Admin\UserController;



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
    Route::patch('/profile/update2', [ProfileController::class, 'update2'])->name('profile.update2');
    Route::delete('/profile/{id}/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/{id}/setting', [ProfileController::class, 'setting'])->name('profile.setting');
    Route::get('/profile/{id}/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/deletion-reason/store', [ProfileController::class, 'deletionReason'])->name('deletion-reason.store');
    // Route::delete('/profile/{id}/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('profile/{id}/show', [ProfileController::class, 'showBookmarkedquotes'])->name('profile.quote');

    // MOOD
    Route::get('/mood/create1', [MoodController::class, 'create1'])->name('mood.save1');
    Route::get('/mood/create', [MoodController::class, 'create'])->name('mood.create');
    Route::get('mood/index', [MoodController::class, 'index'])->name('mood.index');
    Route::post('/mood/store', [MoodController::class, 'store'])->name('mood.store');
});

require __DIR__.'/auth.php';

// Test Page
Route::get('/test', [TestController::class, 'index']);
// Route::get('/test/navbar', function () {
//     return view('test.navbar');
// });
Route::get('/test/test', function () {
    return view('test.test');
// Route::get('/test/navbar', function () {
//     return view('test.navbar');
});
Route::get('/test/test', function () {
    return view('test.test');
});
Route::get('/components/navbar-default', function () {
    return view('components.navbar-default');
});
Route::get('/components/navbar-each', function () {
    return view('components.navbar-each');
});
Route::get('/components/navbar-home', function () {
    return view('components.navbar-home');
});
Route::get('/components/navbar-home-admin', function () {
    return view('components.navbar-home-admin');
});
Route::get('/components/navbar-users', function () {
    return view('components.navbar-users');
});
Route::get('/components/sidebar', function () {
    return view('components.sidebar');
});
Route::get('/components/sidebar-admin', function () {
    return view('components.sidebar-admin');
});
Route::get('/components/footer', function () {
    return view('components.footer');
});


Route::get('/components/sidebar', function () {
    return view('components.sidebar');
});
Route::get('/components/sidebar-admin', function () {
    return view('components.sidebar-admin');
});
Route::get('/components/footer', function () {
    return view('components.footer');
});





//admin route

Route::middleware('auth')->group(function () {

    //quotes
    Route::get('/quote', [QuotesController::class, 'index'])->name('quote.index');
    Route::post('/quote/store',[QuotesController::class, 'store'])->name('quote.store');
    Route::patch('/quote/{id}/update',[QuotesController::class, 'update'])->name('quote.update');
    Route::delete('/quote/{id}/delete',[QuotesController::class, 'destroy'])->name('quote.destroy');
    Route::patch('/quote/{id}/unhide',[QuotesController::class, 'unhide'])->name('quote.unhide');
    Route::delete('/quote/{id}/hide',[QuotesController::class, 'hide'])->name('quote.hide');

    // Contactus
    Route::get('/admin/inquiries',[InquiriesController::class, 'index'])->name('admin.inquiries');
    // ROute::get('/admin/inquiries/search', [InquiriesController::class, 'search'])->name('admin.inquiries.search');
    
    // chats
    Route::get('/admin/chats', [ChatsController::class, 'index'])->name('admin.chats.index');
    Route::get('/admin/chats/search', [ChatsController::class, 'search'])->name('admin.chats.search');
    Route::patch('/admin/chats/{id}/update', [ChatsController::class, 'update'])->name('admin.chats.update');
    Route::delete('/admin/chats/{id}/destroy', [ChatsController::class, 'destroy'])->name('admin.chats.destroy');

     // Deletion Reasons
    Route::get('/admin/deletion-reasons', [DeletionReasonController::class, 'index'])->name('deletion-reasons.index');

    // users
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    // Route::delete('/admin/users/{id}/deactivate', [UserController::class, 'deactivate'])->name('admin.users.deactivate');
    // Route::patch('/admin/users/{id}/activate', [UserController::class, 'activate'])->name('admin.users.activate');
    Route::post('/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.status');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/home', [App\Http\Controllers\HomeController::class, 'change'])->name('home.quote.change');


/**
 * routes related to bookmarks
 */
Route::post('/bookmark/{quote_id}/store', [BookmarkController::class, 'store'])->name('bookmark.store');
Route::delete('/bookmark/{quote_id}/destroy', [BookmarkController::class, 'destroy'])->name('bookmark.destroy');

// journal
Route::get('/journals', [JournalController::class, 'index'])->name('journal.journals');
Route::get('/journal/search', [JournalController::class, 'search'])->name('journal.search');
Route::post('/journal/store', [JournalController::class, 'store'])->name('journal.store');
Route::patch('/journal/{id}/update', [JournalController::class, 'update'])->name('journal.update');
Route::patch('/journal/{id}/update_like', [JournalController::class, 'update_like'])->name('journal.update_like');
Route::patch('/journal/{id}/reply', [JournalController::class, 'reply'])->name('journal.reply');
Route::delete('/journal/{id}/destroy', [JournalController::class, 'destroy'])->name('journal.destroy');

// chatroom
Route::get('/chatroom', [ChatroomController::class, 'index'])->name('chatroom.index');
Route::get('/chatroom/search', [ChatroomController::class, 'search'])->name('chatroom.search');
Route::post('/chatroom/store', [ChatroomController::class, 'store'])->name('chatroom.store');
Route::patch('/chatroom/{id}/update', [ChatroomController::class, 'update'])->name('chatroom.update');
Route::delete('/chatroom/{id}/destroy', [ChatroomController::class, 'destroy'])->name('chatroom.destroy');

Route::get('/chatify', [MessagesController::class, 'index'])->name('chatroom.index');


/**
 * route related to contactus
 */
Route::post('/contactus/store', [InquiryController::class, 'store'])->name('inquiry.store');


});

Auth::routes();
