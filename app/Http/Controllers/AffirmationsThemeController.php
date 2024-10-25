<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AffirmationCategory;

class AffirmationsThemeController extends Controller
{
  public function index()
  {
    $categories = AffirmationCategory::all();
    return view('affirmations.index', compact('categories'));
  }

  public function show($id)
  {
    $category = AffirmationCategory::findOrFail($id);
    $affirmations = $category->affirmations;
    return view('affirmations.show', compact('category', 'affirmations'));
  }
}

/*
Este controlador maneja la lógica para listar categorías de afirmaciones y mostrar detalles de una categoría específica junto con sus afirmaciones en tu aplicación Laravel.

- index(): Método para listar todas las categorías de afirmaciones.
  - Obtiene todas las categorías de afirmaciones desde la base de datos.
  - Retorna la vista 'affirmations.categories' y pasa las categorías obtenidas.

- show($id): Método para mostrar una categoría específica y sus afirmaciones.
  - Busca la categoría por su ID, lanza una excepción si no se encuentra.
  - Obtiene las afirmaciones relacionadas con la categoría.
  - Retorna la vista 'affirmations.category' y pasa la categoría y sus afirmaciones.
*/
