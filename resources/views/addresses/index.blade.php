<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Endereços') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('addresses.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded mb-4">{{ __('Novo Endereço') }}</a>

                    <table class="min-w-full bg-white dark:bg-gray-800">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">{{ __('Cliente') }}</th>
                                <th class="py-2 px-4 border-b">{{ __('Endereço') }}</th>
                                <th class="py-2 px-4 border-b">{{ __('Ações') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($addresses as $address)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $address->customer->name }}</td>
                                    <td class="py-2 px-4 border-b">{{ $address->address }}</td>
                                    <td class="py-2 px-4 border-b">
                                        <a href="{{ route('addresses.show', $address->id) }}" class="text-blue-600">{{ __('Visualizar') }}</a> |
                                        <a href="{{ route('addresses.edit', $address->id) }}" class="text-blue-600">{{ __('Editar') }}</a> |
                                        <form action="{{ route('addresses.destroy', $address->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600">{{ __('Excluir') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>