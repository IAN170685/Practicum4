<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Receta;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index()
    {
        $paciente = auth()->user(); // Asumiendo que el paciente está autenticado
        $recetas = Receta::where('paciente_id', $paciente->idUsuario)->get();
        return view('pacientes.index', compact('paciente', 'recetas'));
    }

    public function show($id)
    {
        $paciente = Paciente::findOrFail($id);
        return view('pacientes.show', compact('paciente'));
    }

    public function update(Request $request, $id)
    {
        $paciente = Paciente::findOrFail($id);
        $paciente->update($request->all());
        return redirect()->route('pacientes.show', $paciente->idUsuario)->with('success', 'Datos actualizados correctamente');
    }
}
