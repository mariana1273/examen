<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('tasks.index'); // Redirige a la vista de tareas (si prefieres tareas)
});

Route::middleware(['auth'])->group(function () {
    // Define la ruta para el dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rutas del perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para las categorías y tareas
    Route::resource('categories', CategoryController::class);
    Route::resource('tasks', TaskController::class);

    // Ruta para cambiar el estado de las tareas
    Route::patch('tasks/{task}/toggle-complete', [TaskController::class, 'toggleComplete'])
        ->name('tasks.toggle-complete');
});

require __DIR__.'/auth.php';
