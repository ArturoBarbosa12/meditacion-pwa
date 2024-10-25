<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\userAffirmations; // Add this line to import the UserAffirmation class

class Affirmation extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'text'];

    public function category()
    {
        return $this->belongsTo(AffirmationCategory::class, 'category_id');
    }

    public function userAffirmations()
    {
        return $this->hasMany(userAffirmations::class, 'affirmation_id');
    }
}
