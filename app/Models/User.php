<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    const ADMIN_ROLE_ID = 1;
    const USER_ROLE_ID = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    /**
     * Use this method to get all the journals of a user
     */
    public function journals(){
        return $this->hasMany(Journal::class);
    }

    public function moods() {
        return $this->hasMany(Mood::class);
    }



    /**
     *  use this method to get all the inquiries of a user
     */
    public function inquiries(){
        return $this->hasMany(Inquiry::class);
    }

    public function deletionReason()
    {
        return $this->hasOne(DeletionReason::class);
    }

    public function chats(){
        return $this->hasMany(Chat::class);
    }

    public function bookmarks(){
        return $this->hasMany(Bookmark::class);
        
    }

    // public function isBookmarked(){
    //     return $this->bookmarks()->where('user_id', Auth::user()->id)->exists();
    // }

    public function bookmarkedQuotes(){
        return $this->belongsToMany(Quote::class, 'bookmarks');
    }

    // public function messages()
    // {
    //     return $this->hasMany(Message::class);
    // }

    // /**
    //  * ユーザーが参加しているチャットルームを取得します（必要に応じて）。
    //  */
    // public function chatRooms()
    // {
    //     return $this->belongsToMany(ChatRoom::class, 'chat_room_user');
    // }
}
