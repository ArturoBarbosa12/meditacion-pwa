<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffirmationCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function affirmations()
    {
        return $this->hasMany(Affirmation::class, 'category_id');
    }
}
