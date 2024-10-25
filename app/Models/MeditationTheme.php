<?php

namespace App\Models;

use App\Models\meditationSessions; // Add this line
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeditationTheme extends Model
{
    // use HasFactory;
    protected $fillable = ['name', 'sound_file', 'description', 'image'];

    public function meditationSessions()
    {
        return $this->hasMany(meditationSessions::class, 'theme_id');
    }
}
