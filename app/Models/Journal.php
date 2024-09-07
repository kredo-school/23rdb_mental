<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


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

    public function journals_include_replying_journal(){
        return $this->belongsTo(Journal::class, 'replying_journal_id');
    }

    public function incrementLikeScore()
    {
        $this->increment('like_score');
        $this->save();
    }

    public function decrementLikeScore()
    {
        $this->decrement('like_score');
        $this->save();
    }

    public function comments(){
        return $this->hasMany(JournalComment::class);
    }
}
