<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'apellido', 'email', 'telefono', 'direccion', 'usuario_id'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'idUsuario');
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

    public function historialMedico()
    {
        return $this->hasMany(HistorialMedico::class);
    }
}
