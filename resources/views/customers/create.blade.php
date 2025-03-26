<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Adicionar Cliente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('customers.store') }}" method="POST">
                        @csrf

                        <!-- Informações do Cliente -->
                        <fieldset class="mb-6">
                            <legend class="text-lg font-semibold">{{ __('Cliente') }}</legend>

                            <div class="mb-4">
                                <label for="name" class="block font-medium text-gray-700">{{ __('Nome') }}</label>
                                <input type="text" id="name" name="customer[name]" class="w-full p-2 border rounded" value="{{ old('customer.name') }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="birth_date" class="block font-medium text-gray-700">{{ __('Data de Nascimento') }}</label>
                                <input type="date" id="birth_date" name="customer[birth_date]" class="w-full p-2 border rounded" value="{{ old('customer.birth_date') }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="document_type" class="block font-medium text-gray-700">{{ __('Tipo do Documento') }}</label>
                                <select id="document_type" name="customer[document_type]" class="w-full p-2 border rounded" required>
                                    <option value="RG" {{ old('customer.document_type') == 'RG' ? 'selected' : '' }}>RG</option>
                                    <option value="CPF" {{ old('customer.document_type') == 'CPF' ? 'selected' : '' }}>CPF</option>
                                    <option value="PASSAPORTE" {{ old('customer.document_type') == 'PASSAPORTE' ? 'selected' : '' }}>Passaporte</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="document_number" class="block font-medium text-gray-700">{{ __('Número do Documento') }}</label>
                                <input type="text" id="document_number" name="customer[document_number]" class="w-full p-2 border rounded" value="{{ old('customer.document_number') }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="cnh_number" class="block font-medium text-gray-700">{{ __('Número da CNH') }}</label>
                                <input type="text" id="cnh_number" name="customer[cnh_number]" class="w-full p-2 border rounded" value="{{ old('customer.cnh_number') }}">
                            </div>

                            <div class="mb-4">
                                <label for="cnh_expiration" class="block font-medium text-gray-700">{{ __('Data de Validade CNH') }}</label>
                                <input type="date" id="cnh_expiration" name="customer[cnh_expiration]" class="w-full p-2 border rounded" value="{{ old('customer.cnh_expiration') }}">
                            </div>

                            <div class="mb-4">
                                <label for="phone" class="block font-medium text-gray-700">{{ __('Telefone Principal') }}</label>
                                <input type="text" id="phone" name="customer[phone]" class="w-full p-2 border rounded" value="{{ old('customer.phone') }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="phone_secondary" class="block font-medium text-gray-700">{{ __('Telefone Secundário') }}</label>
                                <input type="text" id="phone_secondary" name="customer[phone_secondary]" class="w-full p-2 border rounded" value="{{ old('customer.phone_secondary') }}">
                            </div>

                            <div class="mb-4">
                                <label for="observations" class="block font-medium text-gray-700">{{ __('Observações') }}</label>
                                <textarea id="observations" name="customer[observations]" class="w-full p-2 border rounded">{{ old('customer.observations') }}</textarea>
                            </div>
                        </fieldset>

                        <!-- Informações de Endereço -->
                        <fieldset class="mb-6">
                            <legend class="text-lg font-semibold">{{ __('Endereço') }}</legend>

                            <div class="mb-4">
                                <label for="address" class="block font-medium text-gray-700">{{ __('Rua') }}</label>
                                <input type="text" id="address" name="address[address]" class="w-full p-2 border rounded" value="{{ old('address.address') }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="neighbourhood" class="block font-medium text-gray-700">{{ __('Bairro') }}</label>
                                <input type="text" id="neighbourhood" name="address[neighbourhood]" class="w-full p-2 border rounded" value="{{ old('address.neighbourhood') }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="number" class="block font-medium text-gray-700">{{ __('Número') }}</label>
                                <input type="text" id="number" name="address[number]" class="w-full p-2 border rounded" value="{{ old('address.number') }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="zip_code" class="block font-medium text-gray-700">{{ __('CEP') }}</label>
                                <input type="text" id="zip_code" name="address[zip_code]" class="w-full p-2 border rounded" value="{{ old('address.zip_code') }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="complement" class="block font-medium text-gray-700">{{ __('Complemento') }}</label>
                                <input type="text" id="complement" name="address[complement]" class="w-full p-2 border rounded" value="{{ old('address.complement') }}">
                            </div>
                        </fieldset>

                        <!-- Informações de Veículo -->
                        <fieldset class="mb-6">
                            <legend class="text-lg font-semibold">{{ __('Veículo') }}</legend>

                            <div class="mb-4">
                                <label for="vehicle_model" class="block font-medium text-gray-700">{{ __('Modelo') }}</label>
                                <input type="text" id="vehicle_model" name="vehicle[vehicle_model]" class="w-full p-2 border rounded" value="{{ old('vehicle.vehicle_model') }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="manufacturer" class="block font-medium text-gray-700">{{ __('Montadora') }}</label>
                                <input type="text" id="manufacturer" name="vehicle[manufacturer]" class="w-full p-2 border rounded" value="{{ old('vehicle.manufacturer') }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="year_of_manufacture" class="block font-medium text-gray-700">{{ __('Ano de Fabricação') }}</label>
                                <input type="text" id="year_of_manufacture" name="vehicle[year_of_manufacture]" class="w-full p-2 border rounded" value="{{ old('vehicle.year_of_manufacture') }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="license_plate" class="block font-medium text-gray-700">{{ __('Placa') }}</label>
                                <input type="text" id="license_plate" name="vehicle[license_plate]" class="w-full p-2 border rounded" value="{{ old('vehicle.license_plate') }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="chassis" class="block font-medium text-gray-700">{{ __('Chassi') }}</label>
                                <input type="text" id="chassis" name="vehicle[chassis]" class="w-full p-2 border rounded" value="{{ old('vehicle.chassis') }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="renavan" class="block font-medium text-gray-700">{{ __('Renavan') }}</label>
                                <input type="text" id="renavan" name="vehicle[renavan]" class="w-full p-2 border rounded" value="{{ old('vehicle.renavan') }}">
                            </div>
                        </fieldset>

                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">{{ __('Salvar') }}</button>
                        <a href="{{ route('customers.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded ml-4">{{ __('Cancelar') }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>