<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MeditationTheme;

class MeditationThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MeditationTheme::create([
            'name' => 'Montañas',
            'sound_file' => 'montanas.mp3',
            'description' => 'Sonidos relajantes de montañas.',
            'image' => 'montañas.webp'
        ]);

        MeditationTheme::create([
            'name' => 'Ríos',
            'sound_file' => 'rios.mp3',
            'description' => 'Sonidos relajantes de ríos.',
            'image' => 'rios.webp'
        ]);

        MeditationTheme::create([
            'name' => 'Atardecer',
            'sound_file' => 'atardecer.mp3',
            'description' => 'Sonidos relajantes de atardecer.',
            'image' => 'atardecer.webp'
        ]);

        MeditationTheme::create([
            'name' => 'Noche',
            'sound_file' => 'noche.mp3',
            'description' => 'Sonidos relajantes de noche.',
            'image' => 'noche.webp'
        ]);

        MeditationTheme::create([
            'name' => 'Playa',
            'sound_file' => 'playa.mp3',
            'description' => 'Sonidos relajantes de playa.',
            'image' => 'playa.webp'
        ]);

        MeditationTheme::create([
            'name' => 'Cascada',
            'sound_file' => 'cascada.mp3',
            'description' => 'Sonidos relajantes de cascadas.',
            'image' => 'cascada.webp'
        ]);
    }
}
