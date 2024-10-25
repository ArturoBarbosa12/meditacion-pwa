@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Nueva Meditación</h1>

        <!-- Mostrar mensajes de error generales -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario para crear una nueva meditación -->
        <form action="{{ route('admin.meditations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                <!-- Mostrar mensaje de error específico para el campo 'name' -->
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
                <!-- Mostrar mensaje de error específico para el campo 'description' -->
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="sound_file">Archivo de Sonido</label>
                <input type="file" name="sound_file" id="sound_file" class="form-control" required>
                <!-- Mostrar mensaje de error específico para el campo 'sound_file' -->
                @error('sound_file')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Imagen</label>
                <input type="file" name="image" id="image" class="form-control" required>
                <!-- Mostrar mensaje de error específico para el campo 'image' -->
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Crear Meditación</button>
        </form>
    </div>
@endsection
