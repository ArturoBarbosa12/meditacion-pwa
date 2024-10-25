<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Affirmation;


class AffirmationsController extends Controller
{
  public function index()
  {
    $affirmations = Affirmation::all();
    $affirmations = Affirmation::with('category')->paginate(5);
    return view('affirmations.index', compact('affirmations'));
  }

  public function show($id)
  {
    $affirmation = Affirmation::findOrFail($id);
    return view('affirmations.show', compact('affirmation'));
  }


  /*
    // Definición del controlador AffirmationsController
    Este controlador maneja la lógica para listar todas las afirmaciones y mostrar detalles 
    de una afirmación específica en tu aplicación Laravel.

    - index(): Método para listar todas las afirmaciones.
      - Obtiene todas las afirmaciones desde la base de datos.
      - Retorna la vista 'affirmations.index' y pasa las afirmaciones obtenidas.

    - show($id): Método para mostrar una afirmación específica.
      - Busca la afirmación por su ID, lanza una excepción si no se encuentra.
      - Retorna la vista 'affirmations.show' y pasa la afirmación encontrada.
    */
}
