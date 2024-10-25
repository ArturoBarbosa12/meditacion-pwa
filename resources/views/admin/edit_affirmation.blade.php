@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-center">Editar Afirmación</h1>

        <!-- Formulario para editar la afirmación -->
        <form method="POST" action="{{ route('admin.affirmations.update', $affirmation->id) }}">
            @csrf
            @method('PATCH') <!-- Necesario para la actualización de recursos en Laravel -->

            <!-- Selección de Categoría -->
            <div class="mb-3">
                <label for="category_id" class="form-label">Categoría Existente:</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">Seleccionar Categoría</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $category->id == $affirmation->category_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
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
                <textarea name="text" id="text" class="form-control" rows="3" required>{{ $affirmation->text }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Afirmación</button>
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
@endsection
