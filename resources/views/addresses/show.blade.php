<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalhes do Endereço') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <label class="font-medium text-gray-700">{{ __('Cliente') }}</label>
                        <p class="text-gray-900 dark:text-gray-100">{{ $address->customer->name }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="font-medium text-gray-700">{{ __('Endereço') }}</label>
                        <p class="text-gray-900 dark:text-gray-100">{{ $address->address }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="font-medium text-gray-700">{{ __('Número') }}</label>
                        <p class="text-gray-900 dark:text-gray-100">{{ $address->number }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="font-medium text-gray-700">{{ __('CEP') }}</label>
                        <p class="text-gray-900 dark:text-gray-100">{{ $address->zip_code }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="font-medium text-gray-700">{{ __('Complemento') }}</label>
                        <p class="text-gray-900 dark:text-gray-100">{{ $address->complement ?? 'N/A' }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="font-medium text-gray-700">{{ __('Bairro') }}</label>
                        <p class="text-gray-900 dark:text-gray-100">{{ $address->neighbourhood }}</p>
                    </div>

                    <a href="{{ route('addresses.edit', $address->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded">{{ __('Editar') }}</a>
                    <form action="{{ route('addresses.destroy', $address->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded ml-4">{{ __('Excluir') }}</button>
                    </form>
                    <a href="{{ route('addresses.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded ml-4">{{ __('Voltar') }}</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>