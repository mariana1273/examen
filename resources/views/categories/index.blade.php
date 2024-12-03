<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 dark:text-purple-200 leading-tight">
            {{ __('Categorías') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-medium text-purple-800">Lista de Categorías</h3>
                <a href="{{ route('categories.create') }}" 
                   class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                    Nueva Categoría
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-purple-500 dark:text-purple-300 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-purple-500 dark:text-purple-300 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-purple-200 dark:divide-purple-700">
                    @foreach($categories as $category)
                    <tr>
                        <td class="px-6 py-4">{{ $category->name }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('categories.edit', $category) }}" 
                               class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded mr-2">
                                Editar
                            </a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
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
            {{ $categories->links() }} <!-- Mostrar paginación -->
        </div>
    </div>
</x-app-layout>
