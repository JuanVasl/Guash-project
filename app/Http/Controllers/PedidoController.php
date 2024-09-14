<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\TipoDireccion;
use App\Models\Ubicacion;
use App\Models\PrecioServicio;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PedidoController extends Controller
{
    public function inicioPedido(Request $request)
    {
        if ($request->isMethod('post')) {
            // Lógica para manejar solicitud POST
            $fecha = Carbon::now('America/Guatemala');
            $idCliente = auth()->user()->id_cliente;

            $pedido = Pedido::create([
                'fecha' => $fecha,
                'id_cliente' => $idCliente,
                'programado' => 0,
                'id_estado' => 1,
            ]);

            return redirect()->route('pedidos.direcc', $pedido);
        }
    }
    public function direccion(Pedido $pedido)
    {
        $tiposDireccion = TipoDireccion::all();
        $ubicaciones = Ubicacion::all();

        return view('pedidos.direccion', compact('pedido', 'tiposDireccion', 'ubicaciones'));
    }

    public function guardarDireccion(Request $request, Pedido $pedido)
    {
        $request->validate([
            'id_tipo_direcc' => 'required|exists:tipo_direcc,id_tipo_direcc',
            'direccion' => 'required|string',
            'referencia' => 'required|string',
            'id_ubicacion' => 'required|exists:ubicacion,id_ubicacion'
        ]);
        $clienteId = $pedido->cliente->id;

        $this->actualizarDireccionCliente($clienteId, $request->all());

        return redirect()->route('pedidos.servicios', $pedido);
    }

    public function actualizarDireccionCliente($clienteId, $datosDireccion, $pedido)
    {
        $cliente = Cliente::find($clienteId);

        if ($cliente) {
            $cliente->update($datosDireccion);
        } else {
            // Manejar el caso en que el cliente no se encuentre
            return redirect()->back()->withErrors(['cliente' => 'Cliente no encontrado']);
        }

        return redirect()->route('pedidos.servicios', $pedido);
    }

    public function servicios(Pedido $pedido)
    {
        $servicios = PrecioServicio::all();
        return view('pedidos.servicio', compact('pedido', 'servicios'));
    }

    public function guardarServicios(Request $request, Pedido $pedido)
    {
        $request->validate([
            'id_precio_serv' => 'required|exists:precio_servicio,id'
        ]);

        $pedido->update($request->only('id_precio_serv'));

        return redirect()->route('pedidos.resumen', $pedido);
    }

    public function resumen(Pedido $pedido)
    {
        return view('pedidos.resumen', compact('pedido'));
    }

}
