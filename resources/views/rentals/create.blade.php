<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Adicionar Reserva') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="row">
                    <div class="col-12 col-md-8">
                        <legend>{{ __('Add Reservation') }}
                            <a href="{{ route('rentals.index') }}" class="btn btn-link">{{ __('Voltar') }}</a>
                        </legend>

                        <!-- Buscar Cliente -->
                        <div class="reservations form content">
                            <fieldset>
                                <legend>{{ __('Buscar Cliente') }}</legend>
                                <input type="text" id="documentNumberInput" placeholder="Digite o número do documento" class="form-control" />
                                <button id="searchCustomerButton" class="btn btn-primary mt-2">Buscar Cliente</button>
                                <a href="{{ route('customers.create') }}" class="btn btn-link">{{ __('ADCIONAR CLIENTE') }}</a>
                            </fieldset>
                        </div>

                         <!-- Buscar Veículos Disponíveis -->
                         <div class="reservations form content">
                            <fieldset>
                                <legend>{{ __('Buscar Veículos Disponíveis') }}</legend>
                                <input type="date" id="startDateInput" placeholder="Digite a data retirada" class="form-control" />
                                <input type="date" id="returnDateInput" placeholder="Digite a data de retorno" class="form-control mt-2" />
                                <button id="searchAvailebleButton" class="btn btn-primary mt-2">Buscar Veículos</button>
                            </fieldset>
                        </div>

                        <!-- Modal de Veículos -->
                        <div id="myModal" class="modal" style="display:none;">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <h2>Escolha um Veículo</h2>
                                <div id="modalBody">Carregando...</div>
                            </div>
                        </div>

                        <!-- Formulário de Locação -->
                        <div class="reservations form content">
                            <form id="reservationForm" action="{{ route('rentals.store') }}" method="POST">
                                @csrf
                                <fieldset>
                                    @php
                                        $status = [
                                            'active' => 'Ativo',
                                            'completed' => 'Finalizado',
                                            'canceled' => 'Cancelado',
                                        ];
                                    @endphp

                                    <!-- Campo para Veículo -->
                                    <div class="form-group">
                                        <label for="vehicle-id">Veículo</label>
                                        <input type="text" id="vehicle-id" name="trailer_id" class="form-control" readonly />
                                    </div>

                                    <!-- Campo para Data de Retirada -->
                                    <div class="form-group">
                                        <label for="start-date">Data de Retirada</label>
                                        <input type="text" id="start-date" name="rental_date" class="form-control" readonly />
                                    </div>

                                    <!-- Campo para Data de Retorno -->
                                    <div class="form-group">
                                        <label for="return-date">Data de Retorno</label>
                                        <input type="text" id="return-date" name="return_date" class="form-control" readonly />
                                    </div>

                                    <!-- Campo para o Valor do Depósito -->
                                    <div class="form-group">
                                        <label for="deposit-value">Valor do Depósito</label>
                                        <input type="number" id="deposit-value" name="deposit_value" class="form-control" />
                                    </div>

                                    <!-- Campo para o Valor do Contrato -->
                                    <div class="form-group">
                                        <label for="contract-original-value">Valor da Locação</label>
                                        <input type="number" id="contract-original-value" name="contract_original_value" class="form-control" />
                                    </div>

                                    <!-- Campos para Valores Extras, Desconto, etc -->
                                    <div class="form-group">
                                        <label for="advance-value">Valor Pago Antecipado</label>
                                        <input type="number" id="advance-value" name="advance_value" class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <label for="extra-value">Valor Extra</label>
                                        <input type="number" id="extra-value" name="extra_value" class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <label for="discount">Desconto</label>
                                        <input type="number" id="discount" name="discount" class="form-control" />
                                    </div>

                                    <!-- Campo de Status -->
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select id="status" name="status" class="form-control">
                                            @foreach ($status as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Campo para Cliente -->
                                    <div class="form-group">
                                        <label for="customer-id">Cliente</label>
                                        <input type="text" id="customer-id" name="customer_id" class="form-control" readonly />
                                    </div>
                                </fieldset>

                                <button type="button" id="reviewButton" class="btn btn-warning mt-4">{{ __('Revisar Reserva') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Cliente -->
    <div id="myModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Informações do Cliente</h2>
            <div id="modalBody">Carregando...</div>
        </div>
    </div>

    <!-- Modal de Revisão -->
    <div id="reviewModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Revisão das Informações</h2>
            <div id="reviewBody"></div>
            <button id="confirmSubmit" class="btn btn-success">Confirmar e Salvar</button>
        </div>
    </div>
</x-app-layout>

<!-- Inclusão do jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Buscar Cliente
    $('#searchCustomerButton').on('click', function() {
        var documentNumber = $('#documentNumberInput').val();
        $.ajax({
            url: '{{ route("customers.ajaxviewbydocument", ":documentNumber") }}'.replace(':documentNumber', documentNumber),
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data) {
                    $('#modalBody').html(`
                        <p><strong>Nome:</strong> ${data.name}</p>
                        <p><strong>Data de Nascimento:</strong> ${data.birth_date}</p>
                        <p><strong>Número do Documento:</strong> ${data.document_number}</p>
                        <p><strong>Número da CNH:</strong> ${data.cnh_number}</p>
                        <h3>Veículos:</h3>
                        <ul>
                            ${data.vehicles.map(vehicle => `
                                <li>${vehicle.vehicle_model} - Placa: ${vehicle.license_plate}</li>
                            `).join('')}
                        </ul>
                        <button id="setCustomerIdBtn" class="btn btn-dark" data-customer-id="${data.id}">Definir Cliente</button>
                    `);
                    $('#myModal').fadeIn();
                } else {
                    $('#modalBody').html('<p>Nenhum cliente encontrado com esse documento.</p>');
                    $('#myModal').fadeIn();
                }
            },
            error: function() {
                $('#modalBody').html('<p>Erro ao buscar cliente.</p>');
                $('#myModal').fadeIn();
            }
        });
    });

    // Buscar Veículos Disponíveis
    $('#searchAvailebleButton').on('click', function() {
        var startDate = $('#startDateInput').val();
        var returnDate = $('#returnDateInput').val();

        if (!startDate || !returnDate) {
            alert('Por favor, preencha as datas.');
            return;
        }

        $.ajax({
            url: '{{ route("trailers.ajaxViewAvailable") }}', // Rota Laravel
            type: 'POST',
            dataType: 'json',
            data: {
                startDate: startDate,
                returnDate: returnDate,
                _token: '{{ csrf_token() }}'  // CSRF token gerado automaticamente pelo Laravel
            },
            success: function(data) {
                if (data && data.length > 0) {
                    var options = data.map(function(trailer) {
                        return `<option value="${trailer.id}">${trailer.chassis}</option>`;
                    }).join('');

                    $('#modalBody').html(`
                        <select id="vehicles" class="form-control">
                            <option value="0">Selecione o Veículo</option>
                            ${options}
                        </select>
                        <button id="setVehicleIdBtn" class="btn btn-dark">Definir Veículo</button>
                    `);
                    $('#myModal').fadeIn();

                    // Setar o veículo
                    $('#setVehicleIdBtn').on('click', function() {
                        var selectedVehicleId = $('#vehicles').val();
                        if (selectedVehicleId !== "0") {
                            $('#vehicle-id').val(selectedVehicleId);
                            $('#start-date').val(startDate);
                            $('#return-date').val(returnDate);
                            $('#myModal').fadeOut(); 
                        } else {
                            alert('Por favor, selecione um veículo.');
                        }
                    });

                } else {
                    $('#modalBody').html('<p>Nenhum veículo disponível para as datas selecionadas.</p>');
                    $('#myModal').fadeIn();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#modalBody').html(`<p>Erro: ${errorThrown}</p>`);
                $('#myModal').fadeIn();
            }
        });

    });

    // Fechar o modal ao clicar no "X" ou fora do modal
    $('.close').on('click', function() {
        $('#myModal, #reviewModal').fadeOut();
    });

    // Fechar o modal ao clicar fora do modal
    $(window).on('click', function(event) {
        if ($(event.target).is('#myModal') || $(event.target).is('#reviewModal')) {
            $('#myModal, #reviewModal').fadeOut();
        }
    });

    // Configurar Cliente
    $(document).on('click', '#setCustomerIdBtn', function () {
        var customerId = $(this).data('customer-id');
        $('#customer-id').val(customerId);
        $('#myModal').fadeOut();
    });

    // Revisão dos dados
    $('#reviewButton').on('click', function(event) {
        event.preventDefault(); // Impede que o formulário seja enviado
        var formData = $('#reservationForm').serializeArray();
        var reviewContent = formData.map(function(item) {
            return `<p><strong>${item.name}:</strong> ${item.value}</p>`;
        }).join('');
        $('#reviewBody').html(reviewContent);
        $('#reviewModal').fadeIn();
    });

    // Confirmar envio do formulário (Salvar)
    $('#confirmSubmit').on('click', function() {
        // Evitar redirecionamento padrão
        event.preventDefault();

        // Submete o formulário via POST corretamente
        var form = $('#reservationForm');

        // Verifica se o formulário contém o CSRF token
        if (!$('meta[name="csrf-token"]').length) {
            alert('Token CSRF não encontrado.');
            return;
        }

        // Enviar o formulário via AJAX
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                // Sucesso - Exemplo: Redirecionar ou mostrar uma mensagem
                alert('Reserva salva com sucesso!');
                
            },
            error: function(xhr, status, error) {
                // Se houver erro na requisição
                alert('Ocorreu um erro ao salvar a reserva. Tente novamente.');
            }
        });
    });
});
</script>