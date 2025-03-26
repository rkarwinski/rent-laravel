<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Trailer Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p><strong>Nome:</strong> {{ $trailer->name }}</p>
                    <p><strong>Dimensão:</strong> {{ $trailer->trailerDimension->length ?? 'N/A' }}</p>
                    <p><strong>Usuário:</strong> {{ $trailer->user->name ?? 'N/A' }}</p>
                    <a href="{{ route('trailers.edit', $trailer->id) }}" class="text-blue-500">Editar</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>