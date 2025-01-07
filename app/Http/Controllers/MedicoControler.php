<?php

namespace App\Http\Controllers;

use App\Models\MedicoController;
use Illuminate\Http\Request;

class MedicoControler extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'medico_id' => 'required|exists:medicos,id',
        'fecha' => 'required|date',
        'hora' => 'required',
    ]);

    // Verificar disponibilidad del médico
    $disponible = Cita::where('medico_id', $request->medico_id)
                     ->where('fecha', $request->fecha)
                     ->where('hora', $request->hora)
                     ->exists();

    if ($disponible) {
        return redirect()->back()->withErrors(['El médico no está disponible en la fecha y hora seleccionadas.']);
    }

    // Crear la cita
    Cita::create([
        'medico_id' => $request->medico_id,
        'paciente_id' => auth()->user()->id,
        'fecha' => $request->fecha,
        'hora' => $request->hora,
    ]);

    return redirect()->route('pacientes.index')->with('success', 'Cita generada correctamente.');
}

}
