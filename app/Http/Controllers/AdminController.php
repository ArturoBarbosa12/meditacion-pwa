<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MeditationTheme;
use App\Models\AffirmationCategory;
use App\Models\Affirmation;

class AdminController extends Controller
{
    public function index()
    {
        $affirmations = Affirmation::all();
        $themes = MeditationTheme::all();
        return view('admin.index', compact('affirmations', 'themes'));
    }

    public function manageMeditations()
    {
        $themes = MeditationTheme::all();
        return view('admin.meditations', compact('themes'));
    }

    public function create()
    {
        return view('admin.create_meditation');
    }

    public function manageAffirmations()
    {
        $categories = AffirmationCategory::all();
        $affirmations = Affirmation::all();
        $affirmations = Affirmation::with('category')->paginate(5);
        return view('admin.affirmations', compact('categories', 'affirmations'));
    }

    public function createAffirmations()
    {
        $categories = AffirmationCategory::all();
        return view('admin.create_affirmation', compact('categories'));
    }

    public function storeAffirmation(Request $request)
    {
        // Validar los campos
        $request->validate([
            'text' => 'required|string',
            'category_id' => 'required_without:new_category',
            'new_category' => 'nullable|string',
            'new_category_description' => 'nullable|string',
        ]);

        // Verificar si se va a crear una nueva categoría
        $category_id = $request->category_id;
        if ($category_id === 'new' && !empty($request->new_category)) {
            // Crear la nueva categoría
            $category = AffirmationCategory::create([
                'name' => $request->new_category,
                'description' => $request->new_category_description,
            ]);
            $category_id = $category->id;  // Usar el ID de la nueva categoría

        } else {
            $categoryId = $request->category_id;
        }

        // Crear la nueva afirmación
        Affirmation::create([
            'text' => $request->text,
            'category_id' => $category_id,
        ]);

        return redirect()->route('admin.affirmations')->with('success', 'La afirmación fue agregada correctamente.');
    }

    public function createTheme()
    {
        return view('admin.create_theme');
    }

    public function storeTheme(Request $request)
    {
        // Validación
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'sound_file' => 'required|mimes:mp3,wav|max:10240', // Limitar tamaño del archivo (10MB)
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048' // Limitar tamaño (2MB)
        ]);

        // Guardar archivo de sonido
        $soundPath = $request->file('sound_file')->store('sounds', 'public');

        // Guardar imagen
        $imagePath = $request->file('image')->store('images/themes', 'public');

        // Crear el nuevo tema de meditación
        $theme = new MeditationTheme();
        $theme->name = $request->name;
        $theme->description = $request->description;
        $theme->sound_file = $soundPath;
        $theme->image = $imagePath;
        $theme->save();

        return redirect()->route('admin.meditations')->with('success', 'El tema de meditación fue agregado correctamente.');
    }

    public function editAffirmation($id)
    {
        $affirmation = Affirmation::findOrFail($id);
        $categories = AffirmationCategory::all();
        return view('admin.edit_affirmation', compact('affirmation', 'categories'));
    }

    public function updateAffirmation(Request $request, $id)
    {
        $affirmation = Affirmation::findOrFail($id);

        // Guardar la categoría actual de la afirmación antes de la actualización
        $previousCategoryId = $affirmation->category_id;

        $request->validate([
            'text' => 'required',
            'category_id' => 'required_without:new_category',
            'new_category' => 'nullable|required_if:category_id,new',
            'new_category_description' => 'nullable|string',
        ]);

        // Crear nueva categoría si se selecciona "Crear Nueva Categoría"
        if ($request->category_id == 'new') {
            $category = AffirmationCategory::create([
                'name' => $request->new_category,
                'description' => $request->new_category_description, // Guardar la descripción
            ]);
            $categoryId = $category->id;
        } else {
            $categoryId = $request->category_id;
        }

        // Actualizar la afirmación
        $affirmation->update([
            'text' => $request->text,
            'category_id' => $categoryId,
        ]);

        // Verificar si la categoría anterior queda sin afirmaciones y eliminarla si es necesario
        if ($previousCategoryId != $categoryId) {
            $previousCategory = AffirmationCategory::find($previousCategoryId);
            if ($previousCategory && $previousCategory->affirmations->count() == 0) {
                $previousCategory->delete();
            }
        }

        return redirect()->route('admin.affirmations')->with('success', 'Afirmación actualizada con éxito.');
    }

    /*public function editTheme($id)
    {
        $theme = MeditationTheme::findOrFail($id);
        return view('admin.edit_theme', compact('theme'));
    } */

    public function updateTheme(Request $request, $id)
    {
        // Validación
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'sound_file' => 'nullable|mimes:mp3,wav|max:10240', // Limitar tamaño del archivo (10MB)
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048' // Limitar tamaño (2MB)
        ]);

        // Encontrar el tema de meditación
        $theme = MeditationTheme::findOrFail($id);
        $theme->name = $request->name;
        $theme->description = $request->description;

        // Actualizar archivo de sonido si se proporciona
        if ($request->hasFile('sound_file')) {
            $theme->sound_file = $request->file('sound_file')->store('sounds', 'public');
        }

        // Actualizar imagen si se proporciona
        if ($request->hasFile('image')) {
            $theme->image = $request->file('image')->store('images/themes', 'public');
        }

        // Guardar los cambios
        $theme->save();

        // Redireccionar con un mensaje de éxito
        return redirect()->route('admin.meditations')->with('success', 'El tema de meditación fue actualizado correctamente.');
    }

    public function deleteAffirmation($id)
    {
        // Encuentra la afirmación que quieres eliminar
        $affirmation = Affirmation::findOrFail($id);

        // Guarda el ID de la categoría antes de eliminar la afirmación
        $categoryId = $affirmation->category_id;

        // Elimina la afirmación
        $affirmation->delete();

        // Verifica si la categoría ya no tiene afirmaciones asociadas
        $category = AffirmationCategory::find($categoryId);
        if ($category && $category->affirmations()->count() == 0) {
            // Si no hay afirmaciones en la categoría, elimina la categoría
            $category->delete();
        }

        return redirect()->route('admin.affirmations')->with('success', 'La afirmación fue eliminada correctamente.');
    }

    public function deleteTheme($id)
    {
        $theme = MeditationTheme::findOrFail($id);
        $theme->delete();
        return redirect()->route('admin.meditations')->with('success', 'El tema de meditación fue eliminado correctamente.');
    }

    public function editMeditation($id)
    {
        $theme = MeditationTheme::findOrFail($id);
        return view('admin.edit_meditation', compact('theme'));
    }
}
