<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegistroController extends Controller
{
    // Mostrar el formulario de registro
    public function mostrarFormulario()
    {
        return view('inicio.register');
    }

    // Manejar la solicitud de registro
    public function register(Request $request)
    {
        // Validar los datos del formulario
        $this->validator($request->all())->validate();

        // Crear el usuario
        $user = $this->create($request->all());

        // Iniciar sesión automáticamente
        auth()->login($user);

        // Redirigir a la página de inicio o dashboard
        return redirect()->route('usuario.dashboard'); // Cambia según sea necesario
    }

    // Validar los datos del formulario
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:paciente,medico'], 
        ]);
    }

    // Crear un nuevo usuario
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'], // Asegúrate de que el modelo User tenga este campo
        ]);
    }
}