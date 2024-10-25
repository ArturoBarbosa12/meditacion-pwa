@extends('layouts.app')

@section('content')
    <div class="affirmation-container">
        <h1>Afirmaciones Disponibles</h1>
        <div class="affirmation-card-container">
            @foreach ($affirmations as $affirmation)
                <div class="affirmation-card">
                    <a href="{{ route('affirmations.show', $affirmation->id) }}">
                        <!-- Generar una imagen aleatoria entre affirmation_1 y affirmation_28 -->
                        @php
                            $randomImageId = rand(1, 28);
                        @endphp
                        <img src="{{ asset('images/affirmation_' . $randomImageId . '.webp') }}"
                            alt="Afirmación {{ $affirmation->id }}">

                        <div class="affirmation-card-content">
                            <h2>{{ $affirmation->category->name }}</h2>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Enlaces de paginación -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $affirmations->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
