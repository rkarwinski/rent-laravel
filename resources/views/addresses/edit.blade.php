<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Endereço') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('addresses.update', $address->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="customer_id" class="block font-medium text-gray-700">{{ __('Cliente') }}</label>
                            <select id="customer_id" name="customer_id" class="w-full p-2 border rounded" required>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ $address->customer_id == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="address" class="block font-medium text-gray-700">{{ __('Endereço') }}</label>
                            <input type="text" id="address" name="address" class="w-full p-2 border rounded" value="{{ old('address', $address->address) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="number" class="block font-medium text-gray-700">{{ __('Número') }}</label>
                            <input type="text" id="number" name="number" class="w-full p-2 border rounded" value="{{ old('number', $address->number) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="zip_code" class="block font-medium text-gray-700">{{ __('CEP') }}</label>
                            <input type="text" id="zip_code" name="zip_code" class="w-full p-2 border rounded" value="{{ old('zip_code', $address->zip_code) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="complement" class="block font-medium text-gray-700">{{ __('Complemento') }}</label>
                            <input type="text" id="complement" name="complement" class="w-full p-2 border rounded" value="{{ old('complement', $address->complement) }}">
                        </div>

                        <div class="mb-4">
                            <label for="neighbourhood" class="block font-medium text-gray-700">{{ __('Bairro') }}</label>
                            <input type="text" id="neighbourhood" name="neighbourhood" class="w-full p-2 border rounded" value="{{ old('neighbourhood', $address->neighbourhood) }}" required>
                        </div>

                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">{{ __('Salvar') }}</button>
                        <a href="{{ route('addresses.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded ml-4">{{ __('Cancelar') }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>