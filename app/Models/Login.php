<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{

    public function showLoginForm()
    {
        return view('inicio.login');
    }

    public function login(Request $request)
{
    // Validación de los datos del formulario
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Intentar autenticar al usuario
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Redirigir según el rol del usuario
        if ($user->role === 'medico') {
            return redirect()->intended(default: '/Medico.index'); 
        } elseif ($user->role === 'paciente') {
            return redirect()->intended('/Paciente.index'); 
        }
    }

    // Si la autenticación falla, redirigir de vuelta con un mensaje de error
    return redirect()->back()->withErrors(['email' => 'Credenciales incorrectas.'])->withInput();
}

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/inicio.login');
    }
}