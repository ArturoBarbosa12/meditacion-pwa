<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AffirmationCategory;
use App\Models\Affirmation;

class AffirmationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $positivityCategory = AffirmationCategory::create([
            'name' => 'Positividad',
            'description' => 'Afirmaciones positivas para una mentalidad optimista.'
        ]);

        Affirmation::create([
            'text' => 'Hoy es un gran día para ser feliz.',
            'category_id' => $positivityCategory->id
        ]);

        Affirmation::create([
            'text' => 'Mi mente está llena de pensamientos positivos y saludables.',
            'category_id' => $positivityCategory->id
        ]);
    }
}
