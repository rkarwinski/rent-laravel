<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cadastrar Veículo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('vehicles.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="customer_id" class="block font-medium text-gray-700">{{ __('Cliente') }}</label>
                            <select id="customer_id" name="customer_id" class="w-full p-2 border rounded" required>
                                @foreach($customers as $key => $customer)
                                    <option value="{{ $key }}">{{ $customer }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="vehicle_model" class="block font-medium text-gray-700">{{ __('Modelo do Veículo') }}</label>
                            <input type="text" id="vehicle_model" name="vehicle_model" class="w-full p-2 border rounded" value="{{ old('vehicle_model') }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="manufacturer" class="block font-medium text-gray-700">{{ __('Montadora') }}</label>
                            <input type="text" id="manufacturer" name="manufacturer" class="w-full p-2 border rounded" value="{{ old('manufacturer') }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="year_of_manufacture" class="block font-medium text-gray-700">{{ __('Ano de Fabricação') }}</label>
                            <input type="text" id="year_of_manufacture" name="year_of_manufacture" class="w-full p-2 border rounded" value="{{ old('year_of_manufacture') }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="license_plate" class="block font-medium text-gray-700">{{ __('Placa') }}</label>
                            <input type="text" id="license_plate" name="license_plate" class="w-full p-2 border rounded" value="{{ old('license_plate') }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="chassis" class="block font-medium text-gray-700">{{ __('Chassi') }}</label>
                            <input type="text" id="chassis" name="chassis" class="w-full p-2 border rounded" value="{{ old('chassis') }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="renavan" class="block font-medium text-gray-700">{{ __('Renavan') }}</label>
                            <input type="text" id="renavan" name="renavan" class="w-full p-2 border rounded" value="{{ old('renavan') }}" required>
                        </div>

                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">{{ __('Salvar') }}</button>
                        <a href="{{ route('vehicles.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded ml-4">{{ __('Cancelar') }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
