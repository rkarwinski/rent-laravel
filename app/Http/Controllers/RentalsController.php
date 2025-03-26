<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Trailer;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;
use Dompdf\Options;

class RentalsController extends Controller
{
    public function index()
    {
        $rentals = Rental::with(['trailer', 'customer', 'user'])->paginate(10);
        return view('rentals.index', compact('rentals'));
    }

    public function show($id)
    {
        $rental = Rental::with(['trailer', 'customer.address', 'user'])->findOrFail($id);
        return view('rentals.show', compact('rental'));
    }

    public function create()
    {
        $vehicles = Trailer::pluck('model', 'id');
        $customers = Customer::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        return view('rentals.create', compact('vehicles', 'customers', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'trailer_id' => 'required|exists:trailers,id',
            'customer_id' => 'required|exists:customers,id',
            'user_id' => 'nullable|exists:users,id',
            'status' => 'required|string',
            'rental_date' => 'required|date',
            'return_date' => 'nullable|date',
            'deposit_value' => 'required|numeric',
            'contract_original_value' => 'required|numeric',
            'advance_value' => 'nullable|numeric',
            'extra_value' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
        ]);

        $rental = new Rental($validated);
        $rental->user_id = Auth::id() ?? $validated['user_id'];
        $rental->created_at = now();

        if ($rental->save()) {
            return redirect()->route('rentals.show', $rental->id)->with('success', 'Rental created successfully!');
        }

        return back()->withErrors(['error' => 'Unable to create rental. Please try again.']);
    }

    public function edit($id)
    {
        $rental = Rental::findOrFail($id);
        $vehicles = Trailer::pluck('title', 'id');
        $customers = Customer::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        return view('rentals.edit', compact('rental', 'vehicles', 'customers', 'users'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'rental_date' => 'required|date',
            'return_date' => 'nullable|date',
            'deposit_value' => 'required|numeric',
            'contract_original_value' => 'required|numeric',
            'advance_value' => 'nullable|numeric',
            'extra_value' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
        ]);

        $rental = Rental::findOrFail($id);
        $rental->fill($validated);
        $rental->user_id = Auth::id() ?? $validated['user_id'];
        $rental->updated_at = now();

        if ($rental->save()) {
            return redirect()->route('rentals.show', $rental->id)->with('success', 'Rental updated successfully!');
        }

        return back()->withErrors(['error' => 'Unable to update rental. Please try again.']);
    }

    public function showCompleteForm($id)
    {
        // Buscar a locação pelo ID
        $rental = Rental::findOrFail($id);

        // Retornar a view com os dados da locação
        return view('rentals.complete', compact('rental'));
    }

    // Dentro do controlador RentalsController.php
    public function showContract($id)
    {
        // Recupera a locação com suas relações
        $rental = Rental::with(['trailer.trailerDimension', 'customer.address', 'user'])->findOrFail($id);

        // Retorna a view com a locação
        return view('rentals.contract', compact('rental'));
    }

    public function complete(Request $request, $id)
    {
        // Validação dos dados recebidos
        $validated = $request->validate([
            'observation_return' => 'nullable|string',
            'actual_return_date' => 'nullable|date',
            'extra_value' => 'nullable|numeric',
        ]);

        // Buscar a locação pelo ID
        $rental = Rental::findOrFail($id);

        // Preencher os dados da locação com os dados validados
        $rental->fill($validated);

        // Atualizar a data de retorno, se fornecida
        if ($request->has('actual_return_date')) {
            $rental->actual_return_date = $request->input('actual_return_date');
        }

        // Atualizar o valor adicional, se fornecido
        if ($request->has('extra_value')) {
            $rental->extra_value = $request->input('extra_value');
        }

        // Salvar a locação com as alterações
        if ($rental->save()) {
            return redirect()->route('rentals.show', $rental->id)->with('success', 'Locação finalizada com sucesso!');
        }

        return back()->withErrors(['error' => 'Não foi possível finalizar a locação. Tente novamente.']);
    }

    public function cancel($id)
    {
        $rental = Rental::findOrFail($id);

        if($rental->status != 'completed'){
            $rental->status = 'canceled';
            $rental->updated_at = now();
    
            if ($rental->save()) {
                return redirect()->route('rentals.index')->with('success', 'Rental canceled successfully!');
            }
        }

        return back()->withErrors(['error' => 'Unable to canceled rental. Please try again.']);
    }

    public function destroy($id)
    {
        $rental = Rental::findOrFail($id);

        if ($rental->delete()) {
            return redirect()->route('rentals.index')->with('success', 'Rental deleted successfully!');
        }

        return back()->withErrors(['error' => 'Unable to delete rental. Please try again.']);
    }

    public function download($id)
    {
        // Recupera a locação com suas relações
        $rental = Rental::with(['trailer.trailerDimension', 'customer.address', 'user'])->findOrFail($id);

        // Gera o HTML da view que será usada para criar o PDF
        $html = view('rentals.contract', compact('rental'))->render();

        $html = preg_replace('/<div class="controls-print">.*?<\/div>/s', '', $html);

        // Criação do objeto Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);  // Habilita PHP para usar recursos avançados
        $dompdf = new Dompdf($options);

        // Carrega o HTML da view
        $dompdf->loadHtml($html);

        // Define o tamanho do papel e a orientação
        $dompdf->setPaper('A4', 'portrait');

        // Renderiza o PDF (não salva o arquivo, só cria o conteúdo)
        $dompdf->render();

        // Envia o PDF gerado para o download
        return $dompdf->stream('contrato-locacao.pdf', ['Attachment' => true]);
    }
}