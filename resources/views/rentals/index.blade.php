<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Locações') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-semibold text-white">Locações Existentes</h3>
                        <a href="{{ route('rentals.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Adicionar Locação
                        </a>
                    </div>

                    <!-- Tabela de Locações -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto text-white">
                            <thead class="bg-gray-700">
                                <tr>
                                    <th class="px-4 py-2">ID</th>
                                    <th class="px-4 py-2">Cliente</th>
                                    <th class="px-4 py-2">Veículo</th>
                                    <th class="px-4 py-2">Data de Locação</th>
                                    <th class="px-4 py-2">Data de Retorno</th>
                                    <th class="px-4 py-2">Status</th>
                                    <th class="px-4 py-2">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rentals as $rental)
                                    <tr class="border-b border-gray-600">
                                        <td class="px-4 py-3">{{ $rental->id }}</td>
                                        <td class="px-4 py-3">{{ $rental->customer->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-3">{{ $rental->trailer->model ?? 'N/A' }}</td>
                                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($rental->rental_date)->format('d/m/Y') }}</td>
                                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($rental->return_date)->format('d/m/Y') }}</td>
                                        <td class="px-4 py-3">
                                            <span class="px-2 py-1 rounded-lg {{ $rental->status === 'ativo' ? 'bg-green-600' : 'bg-red-600' }}">
                                                {{ ucfirst($rental->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('rentals.show', $rental->id) }}" class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">Ver</a>
                                                <a href="{{ route('rentals.edit', $rental->id) }}" class="px-3 py-1 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg">Editar</a>
                                                <a href="{{ route('rentals.contract', $rental->id) }}" class="px-3 py-1 bg-purple-600 hover:bg-purple-700 text-white rounded-lg">Contrato</a>
                                                <a href="{{ route('rentals.complete', $rental->id) }}" class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white rounded-lg">Finalizar</a>
                                                <a href="{{ route('rentals.cancel', $rental->id) }}" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-lg">Cancelar</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginação -->
                    <div class="mt-6">
                        {{ $rentals->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
