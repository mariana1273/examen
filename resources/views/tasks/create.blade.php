<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 dark:text-purple-200 leading-tight">
            {{ __('Crear Tarea') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-purple-800" for="title">
                                Título
                            </label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   class="mt-1 block w-full rounded-md border-purple-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600"
                                   value="{{ old('title') }}"
                                   required>
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-purple-800" for="description">
                                Descripción
                            </label>
                            <textarea name="description" 
                                      id="description" 
                                      rows="4"
                                      class="mt-1 block w-full rounded-md border-purple-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600"
                                      required>{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-purple-800" for="category_id">
                                Categoría
                            </label>
                            <select name="category_id" 
                                    id="category_id"
                                    class="mt-1 block w-full rounded-md border-purple-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600"
                                    required>
                                <option value="">Selecciona una categoría</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('tasks.index') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Cancelar
                            </a>
                            <button type="submit" 
                                class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                                Crear Tarea
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>