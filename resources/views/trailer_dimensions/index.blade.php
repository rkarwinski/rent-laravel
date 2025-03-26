<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cadastro de Dimensões de Reboques') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                

                <div class="p-6 text-gray-900 dark:text-gray-100">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold text-white">Dimensões Cadastradas</h3>
                    <a href="{{ route('trailer_dimensions.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Adicionar Dimensão
                    </a>
                </div>
                    
                    <table class="table-auto w-full mt-6">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Comprimento</th>
                                <th class="px-4 py-2">Largura</th>
                                <th class="px-4 py-2">Altura</th>
                                <th class="px-4 py-2">Capacidade Máxima</th>
                                <th class="px-4 py-2">Valor da Diária</th>
                                <th class="px-4 py-2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trailerDimensions as $dimension)
                                <tr>
                                    <td class="border px-4 py-2">{{ $dimension->length . 'm' }}</td>
                                    <td class="border px-4 py-2">{{ $dimension->width . 'm' }}</td>
                                    <td class="border px-4 py-2">{{ $dimension->height . 'm' }}</td>
                                    <td class="border px-4 py-2">{{ $dimension->max_load_capacity . 'kg' }}</td>
                                    <td class="border px-4 py-2">{{ 'R$' . number_format($dimension->daily_rate, 2) }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('trailer_dimensions.show', $dimension->id) }}" class="btn btn-info">Visualizar</a>
                                        <a href="{{ route('trailer_dimensions.edit', $dimension->id) }}" class="btn btn-warning">Editar</a>
                                        <form action="{{ route('trailer_dimensions.destroy', $dimension->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-lg">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $trailerDimensions->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>