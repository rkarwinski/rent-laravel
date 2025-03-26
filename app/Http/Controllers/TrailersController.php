<?php

namespace App\Http\Controllers;

use App\Models\Trailer;
use App\Models\TrailerDimension;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Rental;
use Illuminate\Database\Eloquent\Builder;

class TrailersController extends Controller
{
    // Lista todos os trailers com paginação
    public function index()
    {
        $trailers = Trailer::with(['trailerDimension', 'user'])->paginate(10);
        return view('trailers.index', compact('trailers'));
    }

    // Mostra detalhes de um trailer específico
    public function show($id)
    {
        $trailer = Trailer::with(['trailerDimension', 'user'])->findOrFail($id);
        return view('trailers.show', compact('trailer'));
    }

    // Mostra o formulário de criação de trailer
    public function create()
    {
        // Ajustando a query corretamente para Laravel
        $trailerDimensions = TrailerDimension::selectRaw("
            id, CONCAT(
                COALESCE(length::text, ''), ' - ', 
                COALESCE(width::text, ''), ' x ', 
                COALESCE(height::text, '')
            ) as concat_name
        ")->pluck('concat_name', 'id');

        // Obtendo a lista de usuários
        $users = User::pluck('name', 'id');

        return view('trailers.create', compact('trailerDimensions', 'users'));
    }

    // Salva um novo trailer
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'dimension_id' => 'required|exists:trailer_dimensions,id',
        ]);

        $trailer = new Trailer($request->all());
        $trailer->user_id = Auth::id();
        $trailer->created_at = Carbon::now();
        $trailer->updated_at = null;

        if ($trailer->save()) {
            return redirect()->route('trailers.index')->with('success', 'Trailer criado com sucesso.');
        }

        return back()->with('error', 'Erro ao salvar o trailer.');
    }

    // Mostra o formulário de edição
    public function edit($id)
    {
        $trailer = Trailer::findOrFail($id);

        $trailerDimensions = TrailerDimension::selectRaw("
            id, CONCAT(
                COALESCE(length::text, ''), ' - ', 
                COALESCE(width::text, ''), ' x ', 
                COALESCE(height::text, '')
            ) as concat_name
        ")->pluck('concat_name', 'id');

        $users = User::pluck('name', 'id');

        return view('trailers.edit', compact('trailer', 'trailerDimensions', 'users'));
    }

    // Atualiza um trailer existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'dimension_id' => 'required|exists:trailer_dimensions,id',
        ]);

        $trailer = Trailer::findOrFail($id);
        $trailer->fill($request->all());
        $trailer->user_id = Auth::id();
        $trailer->updated_at = Carbon::now();

        if ($trailer->save()) {
            return redirect()->route('trailers.index')->with('success', 'Trailer atualizado com sucesso.');
        }

        return back()->with('error', 'Erro ao atualizar o trailer.');
    }

    // Exclui um trailer
    public function destroy($id)
    {
        $trailer = Trailer::findOrFail($id);

        if ($trailer->delete()) {
            return redirect()->route('trailers.index')->with('success', 'Trailer deletado com sucesso.');
        }

        return back()->with('error', 'Erro ao deletar o trailer.');
    }

    public function ajaxViewAvailable(Request $request)
    {
        // Validação dos parâmetros
        $validated = $request->validate([
            'startDate' => 'required|date',
            'returnDate' => 'required|date',
        ]);

        $startDate = $validated['startDate'];
        $returnDate = $validated['returnDate'];

        // Subquery para encontrar os IDs de veículos alugados
        $subQuery = Rental::where(function (Builder $query) use ($startDate, $returnDate) {
            $query->whereIn('status', ['active', 'pending'])
                ->whereBetween('rental_date', [$startDate, $returnDate])
                ->orWhereBetween('return_date', [$startDate, $returnDate]);
        })
        ->select('trailer_id');

        // Realizar a consulta de veículos disponíveis
        $trailers = Trailer::whereNotIn('id', $subQuery)
            ->get();

        // Verificar se há veículos disponíveis
        if ($trailers->isEmpty()) {
            // Retornar a resposta JSON com erro
            return response()->json(['error' => 'Nenhum veículo disponível.'], 400);
        }

        // Retornar a lista de veículos disponíveis
        return response()->json($trailers);
    }
}