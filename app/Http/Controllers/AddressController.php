<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Customer;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    // Exibir a lista de endereços
    public function index()
    {
        $addresses = Address::with('customer')->get(); // Carrega os endereços e os clientes relacionados
        return view('addresses.index', compact('addresses'));
    }

    // Mostrar o formulário para criar um novo endereço
    public function create()
    {
        $customers = Customer::all(); // Obtém todos os clientes
        return view('addresses.create', compact('customers'));
    }

    public function show(Address $address)
    {
        return view('addresses.show', compact('address'));
    }

    // Armazenar um novo endereço
    public function store(Request $request)
    {
        // Validar os dados do formulário
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'address' => 'required|string|max:255',
            'number' => 'required|string|max:50',
            'zip_code' => 'required|string|max:20',
            'complement' => 'nullable|string|max:255',
            'neighbourhood' => 'required|string|max:255',
        ]);

        // Criar o novo endereço
        Address::create($request->all());

        return redirect()->route('addresses.index')->with('success', 'Endereço criado com sucesso!');
    }

    // Mostrar o formulário para editar um endereço existente
    public function edit(Address $address)
    {
        $customers = Customer::all(); // Obtém todos os clientes
        return view('addresses.edit', compact('address', 'customers'));
    }

    // Atualizar um endereço existente
    public function update(Request $request, Address $address)
    {
        // Validar os dados do formulário
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'address' => 'required|string|max:255',
            'number' => 'required|string|max:50',
            'zip_code' => 'required|string|max:20',
            'complement' => 'nullable|string|max:255',
            'neighbourhood' => 'required|string|max:255',
        ]);

        // Atualizar os dados do endereço
        $address->update($request->all());

        return redirect()->route('addresses.index')->with('success', 'Endereço atualizado com sucesso!');
    }

    // Remover um endereço
    public function destroy(Address $address)
    {
        $address->delete();
        return redirect()->route('addresses.index')->with('success', 'Endereço excluído com sucesso!');
    }
}