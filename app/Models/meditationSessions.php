<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class meditationSessions extends Model
{
    //use HasFactory;
    protected $fillable = [
        'user_id',
        'theme_id',
        'duration',
        'start_time',
        'end_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function theme()
    {
        return $this->belongsTo(MeditationTheme::class, 'theme_id');
    }
}
