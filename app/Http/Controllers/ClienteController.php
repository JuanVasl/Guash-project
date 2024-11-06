<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    public function index()
    {
        return view('Cliente.menu');
    }

    public function registro()
    {
        return view('Cliente.registro');
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'id_cliente');
    }

    public function save(Request $request){
        // Realiza la validación
        $request->validate([
            'nombre_cliente'   => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-záéíóúÁÉÍÓÚñÑ ]+$/', // Solo letras y espacios
            ],
            'apellido_cliente' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-záéíóúÁÉÍÓÚñÑ ]+$/', // Solo letras y espacios
            ],
            'correo_cliente'   => "required|email|unique:cliente,correo_cliente",
            'contra_cliente'   => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',       // Al menos una mayúscula
                'regex:/[0-9]/',       // Al menos un número
                'regex:/[@$!%*?&]/'    // Al menos un carácter especial
            ],
            'tele_cliente'     => "required|regex:/^[0-9]{8}$/",
        ]);

        // Crea el nuevo cliente en la base de datos
        try {
            $nuevoCliente = cliente::create([
                'nombre_cliente'   => $request->nombre_cliente,
                'apellido_cliente' => $request->apellido_cliente,
                'correo_cliente'   => $request->correo_cliente,
                'contra_cliente'   => Hash::make($request->contra_cliente),
                'tele_cliente'     => $request->tele_cliente,
            ]);

            // Inicia sesión automáticamente después del registro
            Auth::login($nuevoCliente);

            // Redirecciona al menú en caso de éxito
            return redirect('/menu');

        } catch (\Exception $e) {
            // Redirecciona con un mensaje de error si la creación falla
            return redirect()->back()->withErrors(['msg' => 'Hubo un problema al registrar el usuario. Inténtalo de nuevo.']);
        }
    }

}
