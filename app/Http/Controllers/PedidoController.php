<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\TipoDireccion;
use App\Models\Ubicacion;
use App\Models\PrecioServicio;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    public function inicioPedido(Request $request)
    {
        if ($request->isMethod('post')) {
            $fecha = Carbon::now('America/Guatemala');
            $idCliente = auth()->user()->id_cliente;
            $pedido = Pedido::create([
                'fecha' => $fecha,
                'id_cliente' => $idCliente,
                'programado' => 0,
                'id_estado' => 1,
            ]);

            return redirect()->route('pedidos.servicios', $pedido);
        }
    }
    public function direccion()
    {
        $tiposDireccion = TipoDireccion::orderBy('id_tipo_direcc', 'asc')->get();
        $ubicaciones = Ubicacion::orderBy('id_ubicacion', 'asc')->get();

        $cliente = Auth::user();

        return view('pedidos.direccion', compact('tiposDireccion', 'ubicaciones', 'cliente'));
    }

    public function guardarDireccion(Request $request)
    {
        $request->validate([
            'id_tipo_direcc' => 'required|exists:tipo_direcc,id_tipo_direcc',
            'direccion' => 'required|string',
            'referencia' => 'required|string',
            'id_ubicacion' => 'required|exists:ubicacion,id_ubicacion'
        ]);

        $cliente = auth()->user();

        $cliente->update([
            'id_ubicacion' => $request->id_ubicacion,
            'direccion' => $request->direccion,
            'referencia' => $request->referencia,
            'id_tipo_direcc' => $request->id_tipo_direcc
        ]);

        return redirect()->route('menu')->with('success', 'Dirección actualizada con éxito.');
    }

    public function servicios(Pedido $pedido)
    {
        $servicios = PrecioServicio::orderBy('id_precio_serv', 'asc')->get();
        return view('pedidos.servicio', compact('pedido', 'servicios'));
    }

    public function guardarServicios(Request $request, Pedido $pedido)
    {
        $request->validate([
            'id_precio_serv' => 'required|exists:precio_servicio,id_precio_serv',
        ]);

        $pedido->id_precio_serv = $request->id_precio_serv;

        $pedido->save();

        return redirect()->route('pedidos.direcc');
    }

    public function resumen(Pedido $pedido)
    {
        return view('pedidos.resumen', compact('pedido'));
    }

}
