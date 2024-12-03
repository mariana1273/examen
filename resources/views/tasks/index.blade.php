<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 dark:text-purple-200 leading-tight">
            {{ __('Tareas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex">
                <!-- Barra lateral de categorías -->
                <div class="w-1/4 bg-white dark:bg-gray-800 p-4">
                    <h3 class="text-lg font-medium text-purple-800">Categorías</h3>
                    <ul class="mt-4">
                        @foreach($categories as $category)
                            <li class="mb-2">
                                <a href="{{ route('tasks.index', ['category' => $category->id]) }}" 
                                   class="text-purple-600 hover:text-purple-800">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Contenido de tareas -->
                <div class="w-3/4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-purple-800">Lista de Tareas</h3>
                        <a href="{{ route('tasks.create') }}" 
                           class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                            Nueva Tarea
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-purple-100 border border-purple-400 text-purple-700 px-4 py-3 rounded relative mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="min-w-full divide-y divide-purple-200 dark:divide-purple-700">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-purple-500 dark:text-purple-300 uppercase tracking-wider">Título</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-purple-500 dark:text-purple-300 uppercase tracking-wider">Descripción</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-purple-500 dark:text-purple-300 uppercase tracking-wider">Categoría</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-purple-500 dark:text-purple-300 uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-purple-500 dark:text-purple-300 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-purple-200 dark:divide-purple-700">
                            @foreach($tasks as $task)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $task->title }}</td>
                                    <td class="px-6 py-4">{{ Str::limit($task->description, 50) }}</td>
                                    <td class="px-6 py-4">{{ $task->category->name }}</td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('tasks.toggle-complete', $task) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                class="{{ $task->completed ? 'bg-purple-500' : 'bg-gray-500' }} text-white px-2 py-1 rounded">
                                                {{ $task->completed ? 'Completada' : 'Pendiente' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('tasks.edit', $task) }}" 
                                           class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded mr-2">
                                           Editar
                                        </a>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded"
                                                onclick="return confirm('¿Estás seguro?')">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Paginación -->
                    {{ $tasks->links() }} <!-- Mostrar paginación -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
