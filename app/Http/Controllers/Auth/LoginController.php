<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\cliente;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('Cliente.loginCliente');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('correo_cliente', 'contra_cliente');

        // Buscamos al cliente por correo
        $cliente = Cliente::where('correo_cliente', $credentials['correo_cliente'])->first();

        // Verificamos si el cliente existe y si la contraseña coincide
        if ($cliente && $cliente->contra_cliente === $credentials['contra_cliente']) {
            Auth::login($cliente); // Iniciamos sesión con el cliente
            return redirect()->intended('menu'); // Redirige al menu
        }

        return back()->withErrors([
            'correo_cliente' => 'Las credenciales son incorrectas.',
        ]);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/'); // Redirigir al formulario de login
    }
}
