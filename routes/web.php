<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/offline', function () {    
    return view('vendor/laravelpwa/offline');
});


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rutas para Meditación
Route::get('/meditations', [App\Http\Controllers\MeditationThemeController::class, 'index'])->name('meditations.index')->middleware('auth');
Route::get('/meditations/{id}', [App\Http\Controllers\MeditationThemeController::class, 'show'])->name('meditations.show')->middleware('auth');
Route::post('/meditation_sessions', [App\Http\Controllers\MeditationController::class, 'store'])->name('meditation_sessions.store')->middleware('auth');

// Rutas para Afirmaciones
Route::get('/affirmations', [App\Http\Controllers\AffirmationsController::class, 'index'])->name('affirmations.index')->middleware('auth');
Route::get('/affirmations/{id}', [App\Http\Controllers\AffirmationsController::class, 'show'])->name('affirmations.show')->middleware('auth');


// Rutas de administración
Route::middleware(['auth', 'admin'])->group(function () {
    // Rutas para la gestión de temas de meditación
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');

    Route::get('/admin/meditations', [App\Http\Controllers\AdminController::class, 'manageMeditations'])->name('admin.meditations');
    Route::get('/admin/meditations/create', [App\Http\Controllers\AdminController::class, 'create'])->name('admin.meditations.create');
    Route::post('/admin/meditations/store', [App\Http\Controllers\AdminController::class, 'storeTheme'])->name('admin.meditations.store');
    Route::get('/admin/meditations/{id}/edit', [App\Http\Controllers\AdminController::class, 'editMeditation'])->name('admin.meditations.edit');
    Route::patch('/admin/meditations/{id}', [App\Http\Controllers\AdminController::class, 'updateTheme'])->name('admin.meditations.update');
    Route::delete('/admin/meditations/{id}', [App\Http\Controllers\AdminController::class, 'deleteTheme'])->name('admin.meditations.destroy');

    Route::get('/admin/affirmations', [App\Http\Controllers\AdminController::class, 'manageAffirmations'])->name('admin.affirmations');
    Route::get('/admin/affirmations/create', [App\Http\Controllers\AdminController::class, 'createAffirmations'])->name('admin.affirmations.create');
    Route::post('/admin/affirmations/store', [App\Http\Controllers\AdminController::class, 'storeAffirmation'])->name('admin.affirmations.store');
    Route::get('/admin/affirmations/{id}/edit', [App\Http\Controllers\AdminController::class, 'editAffirmation'])->name('admin.affirmations.edit');
    Route::patch('/admin/affirmations/{id}', [App\Http\Controllers\AdminController::class, 'updateAffirmation'])->name('admin.affirmations.update');
    Route::delete('/admin/affirmations/{id}', [App\Http\Controllers\AdminController::class, 'deleteAffirmation'])->name('admin.affirmations.destroy');
});
