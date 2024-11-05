<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{

    public function handle(Request $request, Closure $next, ...$roles)
    {

        // Quitar espacios adicionales de los roles
        $roles = array_map('trim', $roles);


        /// Si el usuario es del guard 'usuarios' y tiene el rol "Usuario Master"
        if (Auth::guard('usuarios')->check()) {
            $userRole = trim(Auth::guard('usuarios')->user()->nombre_rol);
            if (in_array($userRole, $roles)) {
                return $next($request);
            }
        }

        // Si el usuario es del guard 'web' y tiene el rol "cliente"
        if (Auth::guard('web')->check() && in_array('cliente', $roles)) {
            return $next($request);
        }


        // Almacena el mensaje de error en la sesión y redirige a la página anterior
        session()->flash('error', 'No tienes autorización para acceder a esta sección.');
        return redirect()->back();
    }
}
