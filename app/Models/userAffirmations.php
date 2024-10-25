<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userAffirmations extends Model
{
    //use HasFactory;
    protected $fillable = [
        'user_id',
        'affirmation_id',
        'viewed_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function affirmation()
    {
        return $this->belongsTo(Affirmation::class, 'affirmation_id');
    }
}
