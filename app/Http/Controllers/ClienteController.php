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

    public function save(Request $request)
    {
        $cliente = $this->validate($request, [
            'nombre_cliente'   => "required",
            'apellido_cliente' => "required",
            'correo_cliente'   => "required",
            'contra_cliente'   => "required",
            'tele_cliente'     => "required",
        ]);

        $nuevoCliente =cliente::create([
            'nombre_cliente'   => $cliente['nombre_cliente'],
            'apellido_cliente' => $cliente['apellido_cliente'],
            'correo_cliente'   => $cliente['correo_cliente'],
            'contra_cliente'   => Hash::make($cliente['contra_cliente']),
            'tele_cliente'     => $cliente['tele_cliente'],
        ]);

        Auth::login($nuevoCliente);

        return redirect('/menu');
    }
}
