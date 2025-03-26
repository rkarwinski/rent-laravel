<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Seguradoras') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-semibold text-white">Seguradoras Cadastradas</h3>
                        <a href="{{ route('insurers.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Adicionar Seguradora
                        </a>
                    </div>

                    <table class="table-auto w-full mt-6">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Nome</th>
                                <th class="px-4 py-2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($insurers as $insurer)
                                <tr>
                                    <td class="border px-4 py-2">{{ $insurer->id }}</td>
                                    <td class="border px-4 py-2">{{ $insurer->name }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('insurers.show', $insurer->id) }}" class="btn btn-info">Ver</a>
                                        <a href="{{ route('insurers.edit', $insurer->id) }}" class="btn btn-warning">Editar</a>
                                        <form action="{{ route('insurers.destroy', $insurer->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir esta seguradora?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-lg">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-6">
                        {{ $insurers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
