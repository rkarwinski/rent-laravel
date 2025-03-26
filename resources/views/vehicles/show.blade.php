<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalhes do Veículo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <strong>{{ __('Modelo:') }}</strong> {{ $vehicle->vehicle_model }}
                    </div>
                    <div class="mb-4">
                        <strong>{{ __('Montadora:') }}</strong> {{ $vehicle->manufacturer }}
                    </div>
                    <div class="mb-4">
                        <strong>{{ __('Ano de Fabricação:') }}</strong> {{ $vehicle->year_of_manufacture }}
                    </div>
                    <div class="mb-4">
                        <strong>{{ __('Placa:') }}</strong> {{ $vehicle->license_plate }}
                    </div>
                    <div class="mb-4">
                        <strong>{{ __('Chassi:') }}</strong> {{ $vehicle->chassis }}
                    </div>
                    <div class="mb-4">
                        <strong>{{ __('Renavan:') }}</strong> {{ $vehicle->renavan }}
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded">{{ __('Editar') }}</a>
                        <a href="{{ route('vehicles.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded ml-4">{{ __('Voltar') }}</a>
                        <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded ml-4" onclick="return confirm('Tem certeza que deseja excluir este veículo?');">{{ __('Excluir') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>