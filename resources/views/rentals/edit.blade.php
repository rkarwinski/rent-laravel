<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Locação') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Flash message for success or error -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('rentals.update', $rental->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="p-6">
                        
                        <div class="mb-4">
                            <label for="rental_date" class="block text-sm font-medium text-gray-700">{{ __('Data de Retirada') }}</label>
                            <input type="date" name="rental_date" id="rental_date" value="{{ old('rental_date', $rental->rental_date) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>

                        <div class="mb-4">
                            <label for="return_date" class="block text-sm font-medium text-gray-700">{{ __('Data de Retorno Prevista') }}</label>
                            <input type="date" name="return_date" id="return_date" value="{{ old('return_date', $rental->return_date ? $rental->return_date : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div class="mb-4">
                            <label for="deposit_value" class="block text-sm font-medium text-gray-700">{{ __('Valor do Depósito') }}</label>
                            <input type="number" name="deposit_value" id="deposit_value" value="{{ old('deposit_value', $rental->deposit_value) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required step="0.01">
                        </div>

                        <div class="mb-4">
                            <label for="contract_original_value" class="block text-sm font-medium text-gray-700">{{ __('Valor Original do Contrato') }}</label>
                            <input type="number" name="contract_original_value" id="contract_original_value" value="{{ old('contract_original_value', $rental->contract_original_value) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required step="0.01">
                        </div>

                        <div class="mb-4">
                            <label for="advance_value" class="block text-sm font-medium text-gray-700">{{ __('Valor Antecipado') }}</label>
                            <input type="number" name="advance_value" id="advance_value" value="{{ old('advance_value', $rental->advance_value) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" step="0.01">
                        </div>

                        <div class="mb-4">
                            <label for="extra_value" class="block text-sm font-medium text-gray-700">{{ __('Custo Extra') }}</label>
                            <input type="number" name="extra_value" id="extra_value" value="{{ old('extra_value', $rental->extra_value) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" step="0.01">
                        </div>

                        <div class="mb-4">
                            <label for="discount" class="block text-sm font-medium text-gray-700">{{ __('Desconto') }}</label>
                            <input type="number" name="discount" id="discount" value="{{ old('discount', $rental->discount) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" step="0.01">
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="btn btn-primary">{{ __('Atualizar Locação') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>