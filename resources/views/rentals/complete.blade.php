<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Finalizar a Locação') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('rentals.complete', $rental->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="p-6">
                        <fieldset>
                            <legend class="text-lg font-semibold">{{ __('Finalizar a Locação') }}
                                <a href="{{ route('rentals.index') }}" class="text-blue-500 text-sm">{{ __('Voltar') }}</a>
                            </legend>

                            <!-- Observações -->
                            <div class="mb-4">
                                <label for="observation_return" class="block text-sm font-medium text-gray-700">{{ __('Observações (Vistoria)') }}</label>
                                <textarea id="observation_return" name="observation_return" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('observation_return', $rental->observation_return) }}</textarea>
                            </div>

                            <!-- Data de Retorno -->
                            <div class="mb-4">
                                <label for="actual_return_date" class="block text-sm font-medium text-gray-700">{{ __('Data de Retorno') }}</label>
                                <input type="date" id="actual_return_date" name="actual_return_date" value="{{ old('actual_return_date', $rental->actual_return_date ? $rental->actual_return_date->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>

                            <!-- Valor Adicional -->
                            <div class="mb-4">
                                <label for="extra_value" class="block text-sm font-medium text-gray-700">{{ __('Valor Adicionar') }}</label>
                                <input type="number" id="extra_value" name="extra_value" value="{{ old('extra_value', $rental->extra_value) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" step="0.01">
                            </div>

                        </fieldset>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="btn btn-primary">{{ __('Finalizar Locação') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>