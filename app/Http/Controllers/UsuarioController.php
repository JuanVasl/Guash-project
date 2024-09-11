<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function vistaLogin()
    {
        return view('Usuario.login');
    }

    public function usuarioMaster()
    {
        return view('Usuario.UsuarioMaster');
    }

    public function loginUsuario(Request $request)
    {
        $credentials = $request->only('usuario', 'contrasena');

        // Buscar al usuario por nombre de usuario
        $usuario = Usuario::where('usuario', $credentials['usuario'])->first();

        // Verificar si el usuario existe y si la contraseña coincide
        if ($usuario && hash('sha256', $credentials['contrasena']) === $usuario->contrasena) {
            Auth::guard('usuarios')->login($usuario); // Iniciamos sesión con el usuario

            // Redirigir según el rol del usuario
            switch ($usuario->id_rol) {
                case 1: // Usuario Master
                    return redirect('/usuarioMaster');
                case 2: //Administrador de Lavanderia
                    return redirect('/menuAdmin');
                case 3: //Lavandero
                    return redirect('/menuLavan');
                default: //Motorista
                    return redirect('/menuMoto');
            }
        }

        return back()->withErrors([
            'usuario' => 'Las credenciales son incorrectas.',
        ]);
    }


    // Cerrar sesión
    public function logoutUsuario(Request $request)
    {
        Auth::logout();
        return redirect('/loginUsuario'); // Redirigir al formulario de login
    }
}
