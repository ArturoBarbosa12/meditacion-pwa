@extends('layouts.app')

@section('content')
    <div class="container">

        <!-- Mostrar mensaje de éxito -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="my-4 text-center" style="color: #333">Gestionar Afirmaciones</h1>

        <!-- Botón para redirigir a la vista de añadir nueva afirmacion -->
        <div class="text-center mb-5">
            <button>
                <a href="{{ route('admin.affirmations.create') }}">Añadir Nueva Afirmación</a>
            </button>
        </div>

        <!-- Lista de afirmaciones existentes -->
        <div class="bg-white p-4 shadow-sm rounded my-5" style="background-color: rgba(255, 255, 255, 0.9);">
            <h2 class="my-4 text-center">Afirmaciones Existentes</h2>
            <ul class="list-group">
                @foreach ($affirmations as $affirmation)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $affirmation->text }}</strong>
                            <br>
                            <small>Categoría: {{ $affirmation->category->name }}</small>
                        </div>
                        <div class="d-flex">
                            <form method="GET" action="{{ route('admin.affirmations.edit', $affirmation->id) }}"
                                class="me-2">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                            </form>
                            <form method="POST" action="{{ route('admin.affirmations.destroy', $affirmation->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>

            <!-- Enlaces de paginación -->
            <div class="mt-4 d-flex justify-content-center">
                {{ $affirmations->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
