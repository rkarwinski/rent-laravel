<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    // Lista todos os veículos
    public function index()
    {
        $vehicles = Vehicle::with('customer')->paginate(10);
        return view('vehicles.index', compact('vehicles'));
    }

    // Mostra detalhes de um veículo específico
    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }

    // Exibe o formulário de criação
    public function create()
    {
        $customers = Customer::pluck('name', 'id');
        return view('vehicles.create', compact('customers'));
    }

    // Armazena um novo veículo
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'vehicle_model' => 'required|string|max:255',
            'manufacturer' => 'required|string|max:255',
            'year_of_manufacture' => 'required|integer|min:1900|max:' . date('Y'),
            'license_plate' => 'required|string|max:20|unique:customer_vehicles,license_plate',
            'chassis' => 'required|string|max:50|unique:customer_vehicles,chassis',
            'renavan' => 'required|string|max:50|unique:customer_vehicles,renavan',
        ]);

        Vehicle::create($validated);

        return redirect()->route('vehicles.index')->with('success', 'Veículo criado com sucesso!');
    }

    // Exibe o formulário de edição
    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    // Atualiza um veículo
    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'vehicle_model' => 'required|string|max:255',
            'manufacturer' => 'required|string|max:255',
            'year_of_manufacture' => 'required|integer|min:1900|max:' . date('Y'),
            'license_plate' => 'required|string|max:20|unique:customer_vehicles,license_plate,' . $vehicle->id,
            'chassis' => 'required|string|max:50|unique:customer_vehicles,chassis,' . $vehicle->id,
            'renavan' => 'required|string|max:50|unique:customer_vehicles,renavan,' . $vehicle->id,
        ]);

        $vehicle->update($validated);

        return redirect()->route('vehicles.index')->with('success', 'Veículo atualizado com sucesso!');
    }

    // Remove um veículo
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('vehicles.index')->with('success', 'Veículo removido com sucesso!');
    }
}