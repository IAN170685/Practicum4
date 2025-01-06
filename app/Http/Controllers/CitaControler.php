<?php

namespace App\Http\Controllers;

use App\Models\CitaController;
use Illuminate\Http\Request;

class CitaControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las citas
        $citas = Cita::all();
        return view('citas.index', compact('citas')); // Asegúrate de que la vista exista
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('citas.create'); // Asegúrate de que la vista exista
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'medico_id' => 'required|exists:medicos,id', // Asegúrate de que el modelo Medico esté correctamente definido
            'paciente_id' => 'required|exists:pacientes,id', // Asegúrate de que el modelo Paciente esté correctamente definido
        ]);

        // Crear una nueva cita
        Cita::create($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cita $cita)
    {
        return view('citas.show', compact('cita')); // Asegúrate de que la vista exista
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cita $cita)
    {
        return view('citas.edit', compact('cita')); // Asegúrate de que la vista exista
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cita $cita)
    {
        // Validar los datos de entrada
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'medico_id' => 'required|exists:medicos,id',
            'paciente_id' => 'required|exists:pacientes,id',
        ]);

        // Actualizar la cita
        $cita->update($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cita $cita)
    {
        $cita->delete();
        return redirect()->route('citas.index')->with('success', 'Cita eliminada exitosamente.');
    }
}
