<?php

namespace App\Http\Controllers;

use App\Models\HistorialMedicoController;
use Illuminate\Http\Request;

class HistorialMedicoControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($paciente_id)
    {
        $paciente = Paciente::findOrFail($paciente_id);
        $historialMedico = HistorialMedico::where('paciente_id', $paciente_id)->get();

        return view('historial_medico.show', compact('paciente', 'historialMedico'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HistorialMedicoController $historialMedicoController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HistorialMedicoController $historialMedicoController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HistorialMedicoController $historialMedicoController)
    {
        //
    }
}
