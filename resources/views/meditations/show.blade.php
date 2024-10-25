@extends('layouts.app')

@section('content')
    <div class="meditation-timer-container">
        <h1>Tema de Meditación: {{ ucfirst($theme->name) }}</h1>

        @php
            $imagePath = null;
            try {
                // Intentar cargar la imagen desde 'images/'
                $imagePath = asset('images/' . $theme->image);
                if (!file_exists(public_path('images/' . $theme->image))) {
                    throw new Exception('Image not found in images/');
                }
            } catch (Exception $e) {
                try {
                    // Intentar cargar la imagen desde 'storage/'
                    $imagePath = asset('storage/' . $theme->image);
                    if (!file_exists(public_path('storage/' . $theme->image))) {
                        throw new Exception('Image not found in storage/');
                    }
                } catch (Exception $e) {
                    // No hacer nada si la imagen no se encuentra en ninguna de las rutas
                    $imagePath = null;
                }
            }
        @endphp

        <div class="meditation-timer-circle"
            @if ($imagePath) style="background-image: url('{{ $imagePath }}'); background-size: cover; background-position: center;" @endif>
            <span id="timer">0:00</span>
        </div>




        @php
            $audioPath = null;
            try {
                // Intentar cargar el audio desde 'audio/'
                $audioPath = asset('audio/' . $theme->sound_file);
                if (!file_exists(public_path('audio/' . $theme->sound_file))) {
                    throw new Exception('Audio not found in audio/');
                }
            } catch (Exception $e) {
                try {
                    // Intentar cargar el audio desde 'storage/'
                    $audioPath = asset('storage/' . $theme->sound_file);
                    if (!file_exists(public_path('storage/' . $theme->sound_file))) {
                        throw new Exception('Audio not found in storage/');
                    }
                } catch (Exception $e) {
                    // No hacer nada si el audio no se encuentra en ninguna de las rutas
                    $audioPath = null;
                }
            }
        @endphp

        @if ($audioPath)
            <audio id="meditation-audio" loop>
                <source src="{{ $audioPath }}" type="audio/mp3">
                Tu navegador no soporta la reproducción de audio.
            </audio>
        @endif

        <div class="meditation-timer-controls">
            <label for="time">Configura el tiempo (minutos):</label>
            <input type="number" id="time" min="1" value="5">
            <div class="meditation-timer-buttons">
                <button id="startPauseButton" onclick="toggleMeditation()">Iniciar</button>
                <button onclick="resetMeditation()">Detener</button>
            </div>
        </div>

        <form id="meditationForm" method="POST" action="{{ route('meditation_sessions.store') }}">
            @csrf
            <input type="hidden" name="duration" id="duration" required>
            <input type="hidden" name="theme_id" value="{{ $theme->id }}">
        </form>
    </div>

    <script>
        let timerInterval;
        let audioElement = document.getElementById('meditation-audio');
        let timerDisplay = document.getElementById('timer');
        let startPauseButton = document.getElementById('startPauseButton');
        let totalSeconds;
        let isPaused = false;
        let isRunning = false;

        function toggleMeditation() {
            if (isRunning) {
                pauseMeditation();
            } else {
                startMeditation();
            }
        }

        function startMeditation() {
            if (!isRunning) {
                if (!isPaused) {
                    let minutes = document.getElementById('time').value;
                    totalSeconds = minutes * 60;
                }

                audioElement.play();
                startPauseButton.textContent = 'Pausar';
                isRunning = true;

                timerInterval = setInterval(function() {
                    if (totalSeconds > 0) {
                        totalSeconds--;
                        let minutesDisplay = Math.floor(totalSeconds / 60);
                        let secondsDisplay = totalSeconds % 60;

                        timerDisplay.textContent =
                            `${minutesDisplay}:${secondsDisplay < 10 ? '0' : ''}${secondsDisplay}`;
                    } else {
                        clearInterval(timerInterval);
                        audioElement.pause();
                        audioElement.currentTime = 0;
                        resetStartPauseButton();
                    }
                }, 1000);
            }
        }

        function pauseMeditation() {
            clearInterval(timerInterval);
            audioElement.pause();
            startPauseButton.textContent = 'Reanudar';
            isPaused = true;
            isRunning = false;
        }

        function resetStartPauseButton() {
            startPauseButton.textContent = 'Iniciar';
            isRunning = false;
            isPaused = false; // Resetear el estado de pausa al reiniciar
            timerDisplay.textContent = '0:00';
        }

        function resetMeditation() {
            clearInterval(timerInterval);
            audioElement.pause();
            audioElement.currentTime = 0;
            timerDisplay.textContent = '0:00';
            resetStartPauseButton();
        }
    </script>
@endsection
