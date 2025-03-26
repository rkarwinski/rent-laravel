<?php

namespace App\Http\Controllers;

use App\Models\TrailerDimension;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrailerDimensionsController extends Controller
{
    /**
     * Display a listing of the trailer dimensions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Buscar trailer dimensions com relação ao usuário logado
        $trailerDimensions = TrailerDimension::paginate(10);

        // Retornar a view com as dimensões
        return view('trailer_dimensions.index', compact('trailerDimensions'));
    }

    /**
     * Display the specified trailer dimension.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Buscar a TrailerDimension
        $trailerDimension = TrailerDimension::findOrFail($id);

        // Retornar a view de visualização
        return view('trailer_dimensions.show', compact('trailerDimension'));
    }

    /**
     * Show the form for creating a new trailer dimension.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Retornar a view de criação
        return view('trailer_dimensions.create');
    }

    /**
     * Store a newly created trailer dimension in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar os dados da requisição
        $validated = $request->validate([
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'max_load_capacity' => 'required|numeric',
            'daily_rate' => 'required|numeric',
            'daily_rate_description' => 'nullable|string',
        ]);

        // Criar nova instância de TrailerDimension
        $trailerDimension = new TrailerDimension($validated);
        $trailerDimension->user_id = Auth::id(); // Atribuir o usuário logado
        $trailerDimension->created_at = now();
        $trailerDimension->updated_at = null;

        // Salvar no banco de dados
        if ($trailerDimension->save()) {
            return redirect()->route('trailer_dimensions.index')->with('success', 'Trailer dimension has been saved.');
        }

        return back()->with('error', 'The trailer dimension could not be saved. Please try again.');
    }

    /**
     * Show the form for editing the specified trailer dimension.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Buscar TrailerDimension pelo id
        $trailerDimension = TrailerDimension::findOrFail($id);

        // Retornar a view de edição
        return view('trailer_dimensions.edit', compact('trailerDimension'));
    }

    /**
     * Update the specified trailer dimension in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validar os dados da requisição
        $validated = $request->validate([
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'max_load_capacity' => 'required|numeric',
            'daily_rate' => 'required|numeric',
            'daily_rate_description' => 'nullable|string',
        ]);

        // Buscar o TrailerDimension
        $trailerDimension = TrailerDimension::findOrFail($id);

        // Atualizar os dados
        $trailerDimension->update($validated);
        $trailerDimension->updated_at = now();

        // Salvar as alterações
        if ($trailerDimension->save()) {
            return redirect()->route('trailer_dimensions.index')->with('success', 'Trailer dimension has been updated.');
        }

        return back()->with('error', 'The trailer dimension could not be updated. Please try again.');
    }

    /**
     * Remove the specified trailer dimension from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Buscar a TrailerDimension
        $trailerDimension = TrailerDimension::findOrFail($id);

        // Deletar a TrailerDimension
        if ($trailerDimension->delete()) {
            return redirect()->route('trailer_dimensions.index')->with('success', 'Trailer dimension has been deleted.');
        }

        return back()->with('error', 'The trailer dimension could not be deleted. Please try again.');
    }
}