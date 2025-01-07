<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use App\Models\Medico;
use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function create()
    {
        $especialidades = Especialidad::all();
        return view('citas.create', compact('especialidades'));
    }

    public function checkAvailability(Request $request)
    {
        $medico_id = $request->input('medico_id');
        $fecha = $request->input('fecha');
        $hora = $request->input('hora');

        $disponible = !Cita::where('medico_id', $medico_id)
                            ->where('fecha', $fecha)
                            ->where('hora', $hora)
                            ->exists();

        return response()->json(['disponible' => $disponible]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'medico_id' => 'required|exists:medicos,id',
            'fecha' => 'required|date',
            'hora' => 'required',
        ]);

        $disponible = !Cita::where('medico_id', $request->medico_id)
                            ->where('fecha', $request->fecha)
                            ->where('hora', $request->hora)
                            ->exists();

        if (!$disponible) {
            return redirect()->back()->withErrors(['El médico no está disponible en la fecha y hora seleccionadas.']);
        }

        Cita::create([
            'paciente_id' => auth()->user()->id,
            'medico_id' => $request->medico_id,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
        ]);

        return redirect()->route('pacientes.index')->with('success', 'Cita generada correctamente.');
    }
}
