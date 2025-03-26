<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Veículos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Botão para criar um novo veículo -->
                    <a href="{{ route('vehicles.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded mb-4 inline-block">{{ __('Novo Veículo') }}</a>

                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border p-2">ID</th>
                                <th class="border p-2">Modelo</th>
                                <th class="border p-2">Montadora</th>
                                <th class="border p-2">Ano</th>
                                <th class="border p-2">Placa</th>
                                <th class="border p-2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($vehicles as $vehicle)
                                <tr>
                                    <td class="border p-2">{{ $vehicle->id }}</td>
                                    <td class="border p-2">{{ $vehicle->vehicle_model }}</td>
                                    <td class="border p-2">{{ $vehicle->manufacturer }}</td>
                                    <td class="border p-2">{{ $vehicle->year_of_manufacture }}</td>
                                    <td class="border p-2">{{ $vehicle->license_plate }}</td>
                                    <td class="border p-2">
                                        <a href="{{ route('vehicles.show', $vehicle) }}" class="text-blue-600">Ver</a>
                                        <a href="{{ route('vehicles.edit', $vehicle) }}" class="text-yellow-600 ml-4">Editar</a>
                                        <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 ml-4" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center p-4">Nenhum veículo encontrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
