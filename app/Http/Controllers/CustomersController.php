<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Address;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Exibe a lista de clientes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::with(['address', 'vehicles'])->paginate(10);
        return view('customers.index', compact('customers'));
    }

    /**
     * Exibe os detalhes de um cliente.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::with(['address', 'vehicles'])->findOrFail($id);
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for creating a new insurer.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Exibe um cliente com base no número de documento via AJAX.
     *
     * @param  string  $documentNumber
     * @return \Illuminate\Http\Response
     */
    public function ajaxViewByDocument($documentNumber)
    {
        $customer = Customer::where('document_number', $documentNumber)
                            ->with(['address', 'vehicles'])
                            ->first();

        if ($customer) {
            return response()->json($customer);
        }

        return response()->json(['error' => 'Cliente não encontrado.'], 404);
    }

    /**
     * Cria um novo cliente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            // Passo 1: Criar o Customer
            $customer = new Customer();
            $customer->fill($data['customer']);
            if ($customer->save()) {
                // Passo 2: Adicionar os dados de Address e Vehicle
                $customerId = $customer->id;
                $address = new Address();
                $address->fill($data['address']);
                $address->customer_id = $customerId;
                $address->save();

                $vehicle = new Vehicle();
                $vehicle->fill($data['vehicle']);
                $vehicle->customer_id = $customerId;
                $vehicle->save();

                // Atualizar Customer com IDs de Address e Vehicle
                $customer->address_id = $address->id;
                $customer->vehicle_id = $vehicle->id;
                $customer->save();

                return redirect()->route('rentals.index')
                                 ->with('success', 'O cliente e registros relacionados foram salvos.');
            }

            return redirect()->back()->with('error', 'O cliente não pôde ser salvo. Tente novamente.');
        }

        $vehicles = Vehicle::all();
        return view('customers.create', compact('customers'));
    }

    /**
     * Edita um cliente existente.
     *
     * @param  string  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $customer = Customer::with(['address', 'vehicles'])->findOrFail($id);

        if ($request->isMethod('post')) {
            $data = $request->all();

            // Atualiza os dados do Customer
            $customer->fill($data['customer']);
            if ($customer->save()) {
                // Atualizar Address
                $address = $customer->Address;
                $address->fill($data['address']);
                $address->save();

                $customer->address_id = $address->id;
                $customer->save();

                return redirect()->route('rentals.index')
                                 ->with('success', 'O cliente e registros relacionados foram atualizados.');
            }

            return redirect()->back()->with('error', 'O cliente não pôde ser atualizado. Tente novamente.');
        }

        return view('customers.edit', compact('customer'));
    }

    /**
     * Deleta um cliente.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $customer = Customer::findOrFail($id);

        if ($customer->delete()) {
            return redirect()->route('customers.index')
                             ->with('success', 'O cliente foi deletado.');
        }

        return redirect()->route('customers.index')
                         ->with('error', 'O cliente não pôde ser deletado. Tente novamente.');
    }
}