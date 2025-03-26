<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Visualizar Locação') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="row">
                    <aside class="column">
                        <div class="side-nav">
                            <a href="{{ route('rentals.create') }}" class="btn btn-success ms-auto">
                                <i class="fas fa-plus"></i> Criar novo
                            </a>
                            <a href="{{ route('rentals.index') }}" class="btn btn-success ms-auto">
                                <i class="fas fa-table"></i> Lista
                            </a>
                            <a href="{{ route('rentals.edit', $rental->id) }}" class="btn btn-warning ms-auto">
                                <i class="fas fa-pencil"></i> Editar
                            </a>
                            <a :href="route('rentals.destroy', $rental->id)" class="btn btn-danger ms-auto" 
                                onclick="event.preventDefault(); if(confirm('Tem certeza que deseja deletar #{{ $rental->id }}?')) document.getElementById('delete-form').submit();">
                                <i class="fas fa-trash"></i> Deletar
                            </a>

                            <form id="delete-form" action="{{ route('rentals.destroy', $rental->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </aside>

                    <div class="column column-80">
                        <div class="rentals view content">
                            <h3>{{ $rental->id }}</h3>
                            <table class="table">
                                <tr>
                                    <th>{{ __('Id') }}</th>
                                    <td>{{ $rental->id }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Status') }}</th>
                                    <td>{{ $rental->status }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Veículo alugado: ') }}</th>
                                    <td>
                                        @if($rental->trailer)
                                            <a href="{{ route('trailers.show', $rental->trailer->id) }}">{{ $rental->trailer->chassis }}</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Cliente') }}</th>
                                    <td>
                                        @if($rental->customer)
                                            <a href="{{ route('customers.show', $rental->customer->id) }}">{{ $rental->customer->name }}</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Data de Retirada') }}</th>
                                    <td>{{ $rental->rental_date }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Data de retorno prevista') }}</th>
                                    <td>{{ $rental->return_date }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Data de retorno') }}</th>
                                    <td>{{ $rental->actual_return_date }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Observação de retorno') }}</th>
                                    <td>{{ $rental->observation_return }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Valor do deposito') }}</th>
                                    <td>{{ $rental->deposit_value !== null ? number_format($rental->deposit_value, 2, ',', '.') : '' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Valor do Alugel') }}</th>
                                    <td>{{ number_format($rental->contract_original_value, 2, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Valor pago antecipado') }}</th>
                                    <td>{{ $rental->advance_value !== null ? number_format($rental->advance_value, 2, ',', '.') : '' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Custo extra') }}</th>
                                    <td>{{ $rental->extra_value !== null ? number_format($rental->extra_value, 2, ',', '.') : '' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Desconto') }}</th>
                                    <td>{{ $rental->discount !== null ? number_format($rental->discount, 2, ',', '.') : '' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Contrato gerado por') }}</th>
                                    <td>
                                        @if($rental->user)
                                            {{ $rental->user->username }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Criado') }}</th>
                                    <td>{{ $rental->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Atualizado') }}</th>
                                    <td>{{ $rental->updated_at }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>