<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Journal extends Model
{
    use HasFactory, SoftDeletes;

    /**
     *  A post belongs to a user
     *  Use this method to get the owner of the post
     */
    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }
}
