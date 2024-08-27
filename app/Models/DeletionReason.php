<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeletionReason extends Model
{
    protected $fillable = ['user_id', 'reason'];

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
