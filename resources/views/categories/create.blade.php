<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 dark:text-purple-200 leading-tight">
            {{ __('Crear Categoría') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-purple-700" for="name">Nombre de la Categoría</label>
                    <input type="text" id="name" name="name" 
                           class="w-full px-3 py-2 border rounded" required>
                </div>
                <button type="submit" 
                        class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                    Guardar
                </button>
            </form>
        </div>
    </div>
</x-app-layout>

