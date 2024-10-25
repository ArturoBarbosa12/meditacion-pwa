@extends('layouts.app')

@section('content')
    @php
        // Genera una imagen aleatoria entre affirmation_1 y affirmation_28
        $randomImageId = rand(1, 28);
    @endphp

    <div class="affirmation-theme-container">
        <div class="affirmation-theme-card">
            <div class="affirmation-theme-image">
                <!-- Usa la imagen aleatoria generada -->
                <img src="{{ asset('images/affirmation_' . $randomImageId . '.webp') }}"
                    alt="Afirmación {{ $randomImageId }}">

                <div class="affirmation-theme-content">
                    <!-- Muestra el ID de la afirmación -->
                    <h1>Afirmación</h1>
                    <!-- Muestra el texto de la afirmación -->
                    <p>{{ $affirmation->text }}</p>


                    <!-- Botón para regresar a la página anterior -->
                    <div class="affirmation-back-button">
                        <a href="{{ route('affirmations.index') }}" class="btn btn-light">Regresar</a>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection
