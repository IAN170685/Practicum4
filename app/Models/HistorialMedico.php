<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historialMedico extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente_id', 'medico_id', 'fecha', 'diagnostico', 'tratamiento', 'notas'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }
}
