<?php

namespace App\Http\Controllers;

use App\Models\InsurerValue;
use App\Models\Insurer;
use Illuminate\Http\Request;

class InsurerValuesController extends Controller
{
    /**
     * Display a listing of the insurer values.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $insurerValues = InsurerValue::with('insurer')->paginate(10);
        return view('insurer_values.index', compact('insurerValues'));
    }

    /**
     * Show the details of an insurer value.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $insurerValue = InsurerValue::with('insurer')->findOrFail($id);
        return view('insurer_values.show', compact('insurerValue'));
    }

    /**
     * Show the form for creating a new insurer value.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insurers = Insurer::all();
        return view('insurer_values.create', compact('insurers'));
    }

    /**
     * Store a newly created insurer value in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'insurer_id' => 'required|exists:insurers,id',
            'age_range' => 'required|string|max:255',
            'state_value' => 'required|numeric',
        ]);

        InsurerValue::create([
            'insurer_id' => $request->insurer_id,
            'age_range' => $request->age_range,
            'state_value' => $request->state_value,
        ]);

        return redirect()->route('insurer_values.index')->with('success', 'Insurer value has been added.');
    }

    /**
     * Show the form for editing an insurer value.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $insurerValue = InsurerValue::findOrFail($id);
        $insurers = Insurer::all();
        return view('insurer_values.edit', compact('insurerValue', 'insurers'));
    }

    /**
     * Update the specified insurer value in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'insurer_id' => 'required|exists:insurers,id',
            'age_range' => 'required|string|max:255',
            'state_value' => 'required|numeric',
        ]);

        $insurerValue = InsurerValue::findOrFail($id);
        $insurerValue->update([
            'insurer_id' => $request->insurer_id,
            'age_range' => $request->age_range,
            'state_value' => $request->state_value,
        ]);

        return redirect()->route('insurer_values.index')->with('success', 'Insurer value has been updated.');
    }

    /**
     * Remove the specified insurer value from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $insurerValue = InsurerValue::findOrFail($id);
        $insurerValue->delete();

        return redirect()->route('insurer_values.index')->with('success', 'Insurer value has been deleted.');
    }
}