<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;


class Quote extends Model
{
    use HasFactory, SoftDeletes;

// a quote belongs to a user
public function user(){
    return $this->belongsTo(User::class)->withTrashed();
}

// use this method to get the bookmarks of a quote
public function bookmarks(){
    return $this->hasMany(Bookmark::class);
    
}

public function isBookmarked(){
    return $this->bookmarks()->where('user_id', Auth::user()->id)->exists();
}

// use this method to sort quote lists
// public function order($select)
// {
//     if($select == 'asc'){
//         return $this->orderBy('created_at', 'asc')->get();
//     } elseif($select == 'desc') {
//         return $this->orderBy('created_at', 'desc')->get();
//     } else {
//         return $this->all();
//     }
// }








}
