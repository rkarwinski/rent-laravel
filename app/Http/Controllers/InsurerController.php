<?php

namespace App\Http\Controllers;

use App\Models\Insurer;
use App\Models\InsurerValue;
use Illuminate\Http\Request;

class InsurerController extends Controller
{
    /**
     * Display a listing of the insurers.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $insurers = Insurer::paginate(10); // Paginação de 10 itens por página

        return view('insurers.index', compact('insurers'));
    }

    /**
     * Display the specified insurer.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $insurer = Insurer::with('insurerValues')->findOrFail($id);

        return view('insurers.show', compact('insurer'));
    }

    /**
     * Show the form for creating a new insurer.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('insurers.create');
    }

    /**
     * Store a newly created insurer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:60',
        ]);

        $insurer = new Insurer();
        $insurer->name = $request->input('name');

        if ($insurer->save()) {
            return redirect()->route('insurers.index')->with('success', 'Insurer created successfully.');
        }

        return back()->withErrors('Error creating insurer.');
    }

    /**
     * Show the form for editing the specified insurer.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $insurer = Insurer::findOrFail($id);

        return view('insurers.edit', compact('insurer'));
    }

    /**
     * Update the specified insurer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:60',
        ]);

        $insurer = Insurer::findOrFail($id);
        $insurer->name = $request->input('name');

        if ($insurer->save()) {
            return redirect()->route('insurers.index')->with('success', 'Insurer updated successfully.');
        }

        return back()->withErrors('Error updating insurer.');
    }

    /**
     * Remove the specified insurer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $insurer = Insurer::findOrFail($id);

        if ($insurer->delete()) {
            return redirect()->route('insurers.index')->with('success', 'Insurer deleted successfully.');
        }

        return back()->withErrors('Error deleting insurer.');
    }
}