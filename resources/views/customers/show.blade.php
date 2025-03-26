<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalhes do Cliente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-2xl font-semibold">{{ $customer->name }}</h3>
                        <div class="space-x-2">
                            <a href="{{ route('customers.create') }}" class="btn btn-success">
                                <i class="fas fa-plus"></i> Criar novo
                            </a>
                            <a href="{{ route('customers.index') }}" class="btn btn-success">
                                <i class="fas fa-table"></i> Lista
                            </a>
                            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning">
                                <i class="fas fa-pencil"></i> Editar
                            </a>
                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar?')">
                                    <i class="fas fa-trash"></i> Deletar
                                </button>
                            </form>
                        </div>
                    </div>

                    <table class="table-auto w-full mb-6">
                        <tr>
                            <th class="px-4 py-2">{{ __('ID') }}</th>
                            <td class="px-4 py-2">{{ $customer->id }}</td>
                        </tr>
                        <tr>
                            <th class="px-4 py-2">{{ __('Nome/Aniversário') }}</th>
                            <td class="px-4 py-2">{{ $customer->name }} / {{ $customer->birth_date }}</td>
                        </tr>
                        <tr>
                            <th class="px-4 py-2">{{ __('Tipo do Documento/Número do Documento') }}</th>
                            <td class="px-4 py-2">{{ $customer->document_type }} / {{ $customer->document_number }}</td>
                        </tr>
                        <tr>
                            <th class="px-4 py-2">{{ __('CNH - Data de Expiração') }}</th>
                            <td class="px-4 py-2">{{ $customer->cnh_number }} - {{ $customer->cnh_expiration }}</td>
                        </tr>
                        <tr>
                            <th class="px-4 py-2">{{ __('Contatos') }}</th>
                            <td class="px-4 py-2">{{ $customer->phone }} / {{ $customer->phone_secondary }}</td>
                        </tr>
                        <tr>
                            <th class="px-4 py-2">{{ __('Observações') }}</th>
                            <td class="px-4 py-2">{{ $customer->observations }}</td>
                        </tr>
                        <tr>
                            <th class="px-4 py-2">{{ __('Criado') }}</th>
                            <td class="px-4 py-2">{{ $customer->created_at }}</td>
                        </tr>
                        <tr>
                            <th class="px-4 py-2">{{ __('Atualizado') }}</th>
                            <td class="px-4 py-2">{{ $customer->updated_at }}</td>
                        </tr>
                    </table>

                    <div class="related">
                        <h4 class="text-xl font-semibold">{{ __('Endereço') }}</h4>
                        @if($customer->address)
                            <div class="overflow-x-auto">
                                <table class="table-auto w-full">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-2">{{ __('Rua') }}</th>
                                            <th class="px-4 py-2">{{ __('Bairro') }}</th>
                                            <th class="px-4 py-2">{{ __('Número') }}</th>
                                            <th class="px-4 py-2">{{ __('CEP') }}</th>
                                            <th class="px-4 py-2">{{ __('Complemento') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="px-4 py-2">{{ $customer->address->address }}</td>
                                            <td class="px-4 py-2">{{ $customer->address->neighbourhood }}</td>
                                            <td class="px-4 py-2">{{ $customer->address->number }}</td>
                                            <td class="px-4 py-2">{{ $customer->address->zip_code }}</td>
                                            <td class="px-4 py-2">{{ $customer->address->complement }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                    <div class="related mt-6">
                        <h4 class="text-xl font-semibold">{{ __('Veículos do Cliente') }}</h4>
                        @if($customer->vehicles->isNotEmpty())
                            <div class="overflow-x-auto">
                                <table class="table-auto w-full">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-2">{{ __('Modelo') }}</th>
                                            <th class="px-4 py-2">{{ __('Montadora') }}</th>
                                            <th class="px-4 py-2">{{ __('Ano') }}</th>
                                            <th class="px-4 py-2">{{ __('Placa') }}</th>
                                            <th class="px-4 py-2">{{ __('Chassi') }}</th>
                                            <th class="px-4 py-2">{{ __('Renavan') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customer->vehicles as $vehicle)
                                            <tr>
                                                <td class="px-4 py-2">{{ $vehicle->vehicle_model }}</td>
                                                <td class="px-4 py-2">{{ $vehicle->manufacturer }}</td>
                                                <td class="px-4 py-2">{{ $vehicle->year_of_manufacture }}</td>
                                                <td class="px-4 py-2">{{ $vehicle->license_plate }}</td>
                                                <td class="px-4 py-2">{{ $vehicle->chassis }}</td>
                                                <td class="px-4 py-2">{{ $vehicle->renavan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
