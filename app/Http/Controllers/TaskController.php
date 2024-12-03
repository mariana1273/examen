<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        // Obtener todas las categorías
        $categories = Category::all();

        // Filtrar tareas por categoría si se pasa la categoría
        if ($request->has('category')) {
            $tasks = Task::where('category_id', $request->category)
                ->paginate(10); // Paginación de 10 tareas por página
        } else {
            $tasks = Task::paginate(10); // Paginación sin filtro de categoría
        }

        return view('tasks.index', compact('tasks', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('tasks.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id'
        ]);

        Task::create($request->all());

        return redirect()->route('tasks.index')
            ->with('success', 'Tarea creada exitosamente.');
    }

    public function edit(Task $task)
    {
        $categories = Category::all();
        return view('tasks.edit', compact('task', 'categories'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id'
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')
            ->with('success', 'Tarea actualizada exitosamente.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Tarea eliminada exitosamente.');
    }

    public function toggleComplete(Task $task)
    {
        $task->update([
            'completed' => !$task->completed
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Estado de la tarea actualizado.');
    }
}
