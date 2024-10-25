@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Mostrar mensaje de éxito -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulario para añadir nueva afirmación -->
        <div class="container">
            <h1 class="mb-4 text-center">Añadir Nueva Afirmación</h1>

            <form method="POST" action="{{ route('admin.affirmations.store') }}">
                @csrf
                <!-- Selección de Categoría -->
                <div class="mb-3">
                    <label for="category_id" class="form-label">Categoría Existente:</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value="">Seleccionar Categoría</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                        <option value="new">Crear Nueva Categoría</option>
                    </select>
                </div>

                <!-- Campo para crear nueva categoría (se muestra solo si se elige "Crear Nueva Categoría") -->
                <div class="mb-3" id="new-category-field" style="display: none;">
                    <label for="new_category" class="form-label">Nueva Categoría:</label>
                    <input type="text" name="new_category" id="new_category" class="form-control">

                    <!-- Campo para la descripción de la nueva categoría -->
                    <label for="new_category_description" class="form-label mt-2">Descripción de la Nueva Categoría:</label>
                    <textarea name="new_category_description" id="new_category_description" class="form-control" rows="2"></textarea>
                </div>

                <!-- Texto de la afirmación -->
                <div class="mb-3">
                    <label for="text" class="form-label">Texto de la Afirmación:</label>
                    <textarea name="text" id="text" class="form-control" rows="3" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Añadir Afirmación</button>
            </form>
        </div>

        <script>
            // Mostrar/ocultar el campo de nueva categoría según la selección
            document.getElementById('category_id').addEventListener('change', function() {
                const newCategoryField = document.getElementById('new-category-field');
                if (this.value === 'new') {
                    newCategoryField.style.display = 'block';
                } else {
                    newCategoryField.style.display = 'none';
                }
            });
        </script>

    </div>
@endsection
