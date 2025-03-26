<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Criar Novo Trailer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Formulário de Criação -->
                    <form action="{{ route('trailers.store') }}" method="POST">
                        @csrf <!-- Token de segurança obrigatório -->

                        <!-- Exibir erros de validação -->
                        @if ($errors->any())
                            <div class="mb-4">
                                <div class="text-red-500 font-semibold">Erros encontrados:</div>
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Título -->
                        <div class="mb-4">
                            <label for="title" class="block font-medium">Título</label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}"
                                class="w-full p-2 border rounded" required>
                        </div>

                        <!-- Chassi -->
                        <div class="mb-4">
                            <label for="chassis" class="block font-medium">Chassi</label>
                            <input type="text" id="chassis" name="chassis" value="{{ old('chassis') }}"
                                class="w-full p-2 border rounded" required>
                        </div>

                        <!-- Modelo -->
                        <div class="mb-4">
                            <label for="model" class="block font-medium">Modelo</label>
                            <input type="text" id="model" name="model" value="{{ old('model') }}"
                                class="w-full p-2 border rounded" required>
                        </div>

                        <!-- Ano de Fabricação -->
                        <div class="mb-4">
                            <label for="manufacturing_date" class="block font-medium">Ano de Fabricação</label>
                            <input type="number" id="manufacturing_date" name="manufacturing_date"
                                value="{{ old('manufacturing_date') }}"
                                min="1900" max="{{ date('Y') }}" step="1"
                                class="w-full p-2 border rounded" required>
                        </div>

                        <!-- Placa -->
                        <div class="mb-4">
                            <label for="licence_plate" class="block font-medium">Placa</label>
                            <input type="text" id="licence_plate" name="licence_plate"
                                value="{{ old('licence_plate') }}" class="w-full p-2 border rounded" required>
                        </div>

                        <!-- Marca -->
                        <div class="mb-4">
                            <label for="brand" class="block font-medium">Marca</label>
                            <input type="text" id="brand" name="brand" value="{{ old('brand') }}"
                                class="w-full p-2 border rounded" required>
                        </div>

                        <!-- Tamanho da Roda -->
                        <div class="mb-4">
                            <label for="wheel_size" class="block font-medium">Tamanho da Roda</label>
                            <input type="text" id="wheel_size" name="wheel_size"
                                value="{{ old('wheel_size') }}" class="w-full p-2 border rounded">
                        </div>

                        <!-- Dimensão -->
                        <div class="mb-4">
                            <label for="dimension_id" class="block font-medium">Dimensão</label>
                            <select id="dimension_id" name="dimension_id" class="w-full p-2 border rounded" required>
                                @foreach($trailerDimensions as $id => $name)
                                    <option value="{{ $id }}" {{ old('dimension_id') == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Capacidade -->
                        <div class="mb-4">
                            <label for="capacity" class="block font-medium">Capacidade (kg)</label>
                            <input type="number" id="capacity" name="capacity"
                                value="{{ old('capacity') }}" class="w-full p-2 border rounded" required>
                        </div>

                        <!-- Cor -->
                        <div class="mb-4">
                            <label for="color" class="block font-medium">Cor</label>
                            <input type="text" id="color" name="color" value="{{ old('color') }}"
                                class="w-full p-2 border rounded">
                        </div>

                        <!-- Número de Eixos -->
                        <div class="mb-4">
                            <label for="axle_count" class="block font-medium">Número de Eixos</label>
                            <input type="number" id="axle_count" name="axle_count"
                                value="{{ old('axle_count') }}" class="w-full p-2 border rounded">
                        </div>

                        <!-- Tipo de Veículo -->
                        <div class="mb-4">
                            <label for="vehicle_type" class="block font-medium">Tipo de Veículo</label>
                            <input type="text" id="vehicle_type" name="vehicle_type"
                                value="{{ old('vehicle_type') }}" class="w-full p-2 border rounded">
                        </div>

                        <!-- Botões -->
                        <div class="flex justify-between mt-6">
                            <!-- Voltar -->
                            <a href="{{ route('trailers.index') }}"
                                class="px-4 py-2 bg-gray-500 text-white rounded">Cancelar</a>

                            <!-- Salvar -->
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded">Salvar Trailer</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>