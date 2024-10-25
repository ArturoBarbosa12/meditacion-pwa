@extends('layouts.app')

@section('content')
    <div class="meditation-container">
        <h1 class="mt-3" style="color: #333">Meditaciones Disponibles</h1>
        <div class="meditation-card-container mb-5">
            @foreach ($themes as $theme)
                <div class="meditation-card">
                    <a href="{{ route('meditations.show', $theme->id) }}">

                        {{-- Como primero cargue imagenes utilizando un seeder y las imagenes se guardaron 
                        en la carpeta public/images y no en la carpeta storage/app/public, entonces
                        se debe cambiar la ruta de la imagen en el siguiente bloque de código para que
                        cargue las imagenes desde la carpeta storage/app/public/images/themes

                         --}}
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

                        @if ($imagePath)
                            <img src="{{ $imagePath }}" alt="{{ $theme->name }}" class="card-img-top">
                        @endif

                        <!-- Hasta aqui va la logica de chequear las imagenes
                                                            <img src="{{ asset('images/' . $theme->image) }}" alt="{{ $theme->name }}">
                                                            <img src="{{ asset('storage/' . $theme->image) }}" alt="{{ $theme->name }}" class="card-img-top">
                                                            antes funcionaba con una de las dos anteriores
                                                        -->


                        <div class="meditation-card-content">
                            <h2>{{ $theme->name }}</h2>
                            <p>{{ $theme->description }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
