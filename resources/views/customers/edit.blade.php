<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Cliente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Informações do Cliente -->
                        <fieldset class="mb-6">
                            <legend class="text-lg font-semibold">{{ __('Cliente') }}</legend>

                            <div class="mb-4">
                                <label for="name" class="block font-medium text-gray-700">{{ __('Nome') }}</label>
                                <input type="text" id="name" name="customer[name]" class="w-full p-2 border rounded" value="{{ old('customer.name', $customer->name) }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="birth_date" class="block font-medium text-gray-700">{{ __('Data de Nascimento') }}</label>
                                <input type="date" id="birth_date" name="customer[birth_date]" class="w-full p-2 border rounded" value="{{ old('customer.birth_date', $customer->birth_date) }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="phone" class="block font-medium text-gray-700">{{ __('Telefone Principal') }}</label>
                                <input type="text" id="phone" name="customer[phone]" class="w-full p-2 border rounded" value="{{ old('customer.phone', $customer->phone) }}" required>
                            </div>
                        </fieldset>

                        <!-- Informações de Endereço -->
                        <fieldset class="mb-6">
                            <legend class="text-lg font-semibold">{{ __('Endereço') }}</legend>

                            <div class="mb-4">
                                <label for="address" class="block font-medium text-gray-700">{{ __('Rua') }}</label>
                                <input type="text" id="address" name="address[address]" class="w-full p-2 border rounded" value="{{ old('address.address', $customer->address->address) }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="neighbourhood" class="block font-medium text-gray-700">{{ __('Bairro') }}</label>
                                <input type="text" id="neighbourhood" name="address[neighbourhood]" class="w-full p-2 border rounded" value="{{ old('address.neighbourhood', $customer->address->neighbourhood) }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="zip_code" class="block font-medium text-gray-700">{{ __('CEP') }}</label>
                                <input type="text" id="zip_code" name="address[zip_code]" class="w-full p-2 border rounded" value="{{ old('address.zip_code', $customer->address->zip_code) }}" required>
                            </div>
                        </fieldset>

                        <!-- Veículos (Apenas Exibição) -->
                        <fieldset class="mb-6">
                            <legend class="text-lg font-semibold">{{ __('Veículos Cadastrados') }}</legend>

                            @forelse($customer->vehicles as $vehicle)
                                <div class="mb-4 border p-4 rounded-lg">
                                    <p><strong>Modelo:</strong> {{ $vehicle->vehicle_model }}</p>
                                    <p><strong>Montadora:</strong> {{ $vehicle->manufacturer }}</p>
                                    <p><strong>Ano:</strong> {{ $vehicle->year_of_manufacture }}</p>
                                    <p><strong>Placa:</strong> {{ $vehicle->license_plate }}</p>
                                </div>
                            @empty
                                <p>Nenhum veículo cadastrado.</p>
                            @endforelse
                        </fieldset>

                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">{{ __('Salvar') }}</button>
                        <a href="{{ route('customers.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded ml-4">{{ __('Cancelar') }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
