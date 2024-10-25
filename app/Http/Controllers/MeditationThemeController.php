<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MeditationTheme;

class MeditationThemeController extends Controller
{
  public function index()
  {
    $themes = MeditationTheme::all();
    return view('meditations.index', compact('themes'));
  }

  public function show($id)
  {
    $theme = MeditationTheme::findOrFail($id);
    return view('meditations.show', compact('theme'));
  }
}

/*
Este controlador maneja la lógica para listar todos los temas de meditación y mostrar 
detalles de un tema específico en tu aplicación Laravel.

- index(): Método para listar todos los temas de meditación.
  - Obtiene todos los temas de meditación desde la base de datos.
  - Retorna la vista 'meditation.index' y pasa los temas obtenidos.

- show($id): Método para mostrar un tema de meditación específico.
  - Busca el tema de meditación por su ID, lanza una excepción si no se encuentra.
  - Retorna la vista 'meditations.show' y pasa el tema encontrado.
*/