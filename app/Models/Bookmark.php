<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Bookmark extends Model
{
    use HasFactory;

    public $timestamps = false;   


    // use this method to get the bookmarks of a quote
public function quotes(){
    return $this->hasMany(Quote::class);
    
}

public function user(){
    return $this->belongsTo(User::class)->withTrashed();
}




}
