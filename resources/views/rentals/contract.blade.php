<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato de Locação de Reboque</title>

    <style>
        .controls-print {
            text-align: center;
            padding: 20px;
        }

        #contract {
            border: 1px solid black; 
            padding: 20px;
        }

        body {
            width: 65%;
            margin: 0 auto;
        }

        /* CSS para esconder tudo exceto a div para impressão */
        @media print {
            body * {
                visibility: hidden;
            }
            #contract, #contract * {
                visibility: visible;
            }
            #contract {
                position: absolute;
                left: 0;
                top: 0;
                border: none; 
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="controls-print">
        {{-- Botão para Download do PDF --}}
        <a href="{{ route('rentals.download', ['id' => $rental->id]) }}" class="btn btn-primary">Download PDF</a>

        {{-- Botão para Imprimir --}}
        <button onclick="window.print();" class="btn btn-secondary">Imprimir</button>

        {{-- Botão para voltar --}}
        <a href="{{ route('rentals.index') }}" class="btn btn-dark">Voltar</a>
    </div>

    {{-- Detalhes do contrato --}}
    @php
        $addresses = $rental->customer->address; 
        $dimensions = $rental->trailer->trailerDimension;
        $dia = date('d'); 
        $meses = [
            1 => 'janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 
            'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro'
        ];
        $mes = $meses[date('n')]; 
        $ano = date('Y'); 
    @endphp

    <div id="contract">
        <h1>CONTRATO DE LOCAÇÃO DE REBOQUE</h1>
        <p>Pelo presente Instrumento particular, de um lado <strong>DELIANE LEIVAS TAVARES</strong>, com sede na Av. Boqueirão, 3895, Estância Velha, Canoas, RS, inscrita no CNPJ 53.605.497/0001-38, doravante denominada simplesmente <strong>LOCADORA</strong>;</p>
        <p>e de outro,</p>
        <p>Nome: {{ $rental->customer->name }}, CPF: {{ $rental->customer->document_number }}, CNH: {{ $rental->customer->cnh_number }}</p>
        <p>Validade: {{ $rental->customer->cnh_expiration }}, residente e domiciliado à {{ $addresses->address }}</p>
        <p>Bairro: {{ $addresses->neighbourhood ?? ' - ' }} número: {{ $addresses->number }}, complemento: {{ $addresses->complement ?? '-' }}</p>
        <p>CEP: {{ $addresses->zip_code }} Contato: {{ $rental->customer->phone }} doravante denominado simplesmente <strong>LOCATÁRIO (A)</strong>, têm justo e contratado o seguinte:</p>
        
        <h2>DO CELEBRADO ENTRE OS PACTUANTES:</h2>
        
        <h3>CLÁUSULA 1ª:</h3>
        <p>O presente CONTRATO tem por OBJETO a LOCAÇÃO DE REBOQUE de propriedade da LOCADORA, conforme descrita abaixo, cujas, características estão devidamente especificadas no demonstrativo de locação (check list), o qual se encontra em perfeito estado de uso, conservação e funcionamento, obrigando-se o LOCATÁRIO (A) a devolvê-la nas mesmas condições.</p>
        <p><strong>Veículo:</strong> Reboque Marca {{ $rental->trailer->brand ?? '-' }} Tam: {{ $dimensions->length . ' X ' . $dimensions->width }}, {{ $rental->trailer->axle_count }} eixo, cor {{ $rental->trailer->color }}, ano/modelo {{ $rental->trailer->manufacturing_date . '/' . $rental->trailer->model }} Placa: {{ $rental->trailer->licence_plate ?? '' }}</p>
        <p>Chassi: {{ $rental->trailer->chassis }}</p>
        
        <h3>CLÁUSULA 2ª:</h3>
        <p>O valor da locação é de R$ {{ number_format($dimensions->daily_rate, 2, ',', '.') }} ({{ $dimensions->daily_rate_description ?? ' - ' }}) a diária, da qual o LOCATÁRIO (A) declara ter plenos conhecimentos, devendo ser inteiramente pago no ato da locação, sendo que em caso de entrega posterior à data prevista de entrega, será cobrado a diária até a data da efetiva entrega.</p>
        <p>Data de Saída: {{ $rental->rental_date }} as {{ $rental->rental_date }} hs.</p>
        <p>Data Prevista de Entrega: {{ $rental->return_date }} as {{ $rental->return_date }} hs.</p>
        <p>Data Efetiva da Entrega: ___ / ___ / ______ as ______ hs.</p>
        
        <p><strong>Parágrafo Único:</strong> Após vencido o prazo de locação, o LOCATÁRIO (A) não poderá permanecer na posse do reboque locado, salvo expressa permissão da LOCADORA, sob pena de serem tomadas as medidas judiciais cabíveis, tanto na área cível como criminal, incorrendo inclusive no crime de apropriação indébita.</p>
        
        <h3>CLÁUSULA 3ª:</h3>
        <p>O check list é parte integrante das condições gerais de contrato de locação de reboques.</p>

        <h3>CLÁUSULA 4ª:</h3>
        <p>A LOCADORA se obriga a entregar o reboque locado em perfeitas condições de conservação e funcionamento, o que deverá ser examinado pelo LOCATÁRIO (A) no momento da locação.</p>

        <h3>CLÁUSULA 5ª:</h3>
        <p>A devolução do reboque deverá ser feita no prazo previsto, no local de retirada informado pela LOCADORA, em perfeitas condições de uso e funcionamento. No momento da devolução será feita uma vistoria.</p>
        <p><strong>Parágrafo Primeiro:</strong> Danos ou alterações no reboque serão considerados desgastes anormais.</p>
        <p><strong>Parágrafo Segundo:</strong> Em caso de danos aos pneus, o LOCATÁRIO deverá pagar pelo pneu novo.</p>
        <p><strong>Parágrafo Terceiro:</strong> A não devolução dos documentos implicará em cobrança de taxas de reposição.</p>
        
        <h3>CLÁUSULA 6ª:</h3>
        <p>O LOCATÁRIO será responsável por eventuais multas e infrações cometidas durante a locação.</p>

        <h3>CLÁUSULA 7ª:</h3>
        <p>Em caso de roubo, furto, colisão ou perda total, o LOCATÁRIO deverá pagar o valor equivalente a 100% do reboque novo, além de lucros cessantes.</p>

        <h3>CLÁUSULA 8ª:</h3>
        <p>O reboque locado deverá ser utilizado exclusivamente em território nacional e em vias asfaltadas ou em condições normais de rodagem.</p>

        <h3>CLÁUSULA 9ª:</h3>
        <p>As despesas de licenciamento e renovações do reboque locado serão de responsabilidade exclusiva da LOCADORA.</p>

        <h3>CLÁUSULA 10ª:</h3>
        <p>Na ocorrência de qualquer acidente ou sinistro envolvendo o reboque, o LOCATÁRIO se obriga a tomar as providências necessárias e informar a LOCADORA.</p>

        <h3>CLÁUSULA 11ª:</h3>
        <p>Todos os débitos resultantes deste contrato terão vencimento na data estipulada no contrato de locação.</p>

        <h3>CLÁUSULA 12ª:</h3>
        <p>Este contrato foi firmado de acordo com a legislação vigente, obrigando também seus herdeiros e sucessores.</p>

        <h3>CLÁUSULA 13ª:</h3>
        <p>As partes elegem o foro de Canoas RS, para dirimir quaisquer dúvidas oriundas deste contrato.</p>

        <p>Canoas, {{ $dia }} de {{ $mes }} de {{ $ano }}.</p>

        <p>DELIANE LEIVAS TAVARES - LOCADORA</p>
        <p>________________________________ LOCATÁRIO (A)</p>
    </div>
</body>
</html>