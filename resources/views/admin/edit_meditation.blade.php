@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Meditación</h1>

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

        <!-- Formulario para editar una meditación existente -->
        <form action="{{ route('admin.meditations.update', $theme->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ old('name', $theme->name) }}" required>
                <!-- Mostrar mensaje de error específico para el campo 'name' -->
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea name="description" id="description" class="form-control" required>{{ old('description', $theme->description) }}</textarea>
                <!-- Mostrar mensaje de error específico para el campo 'description' -->
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="sound_file">Archivo de Sonido</label>
                <input type="file" name="sound_file" id="sound_file" class="form-control">
                <!-- Mostrar mensaje de error específico para el campo 'sound_file' -->
                @error('sound_file')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Imagen</label>
                <input type="file" name="image" id="image" class="form-control">
                <!-- Mostrar mensaje de error específico para el campo 'image' -->
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Meditación</button>
        </form>
    </div>
@endsection
