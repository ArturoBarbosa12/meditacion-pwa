<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\meditationSessions;

class MeditationController extends Controller
{

    public function store(Request $request)
    {
        $session = new meditationSessions();
        $session->user_id = auth()->id();
        $session->theme_id = $request->theme_id;
        $session->duration = $request->duration;
        $session->start_time = now();
        $session->save();

        return redirect()->route('meditations.start', $session->id);
    }

    public function show($id)
    {
        $session = meditationSessions::findOrFail($id);
        return view('meditations.start', compact('session'));
    }

    public function end($id)
    {
        $session = meditationSessions::findOrFail($id);
        $session->end_time = now();
        $session->save();

        return redirect()->route('meditations.summary', $session->id);
    }
}

/*
Este controlador maneja la lógica para almacenar y mostrar sesiones de meditación 
en tu aplicación Laravel.

- store(Request $request): Método para almacenar una nueva sesión de meditación.
  - Crea una nueva instancia del modelo meditationSessions.
  - Asigna el ID del usuario autenticado a la sesión.
  - Asigna el ID del tema de meditación desde la solicitud.
  - Asigna la duración de la sesión desde la solicitud.
  - Asigna la hora de inicio de la sesión a la hora actual.
  - Guarda la sesión en la base de datos.
  - Redirige al usuario a la pantalla de inicio de la meditación con el ID de la sesión.

- show($id): Método para mostrar una sesión de meditación específica.
  - Busca la sesión de meditación por su ID, lanza una excepción si no se encuentra.
  - Retorna la vista 'meditations.start' y pasa la sesión encontrada.

- end($id): Método para finalizar una sesión de meditación.
  - Busca la sesión de meditación por su ID, lanza una excepción si no se encuentra.
  - Asigna la hora de finalización de la sesión a la hora actual.
  - Guarda la sesión actualizada en la base de datos.
  - Redirige al usuario a la pantalla de resumen de la meditación con el ID de la sesión.

*/