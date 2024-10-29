<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Motorista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MotoristaController extends Controller
{
    public function indexMotorista()
    {
        return view('Motorista.menuMotorista');
    }

    public function entregas()
    {
        // Obtener el id del usuario logeado
        $usuario = Auth::guard('usuarios')->user();
        $idMotorista = $usuario->id_usuario;

        $entrega = DB::table('pedido')
            ->join('cliente', 'pedido.id_cliente', '=', 'cliente.id_cliente')
            ->join('ubicacion', 'cliente.id_ubicacion', '=', 'ubicacion.id_ubicacion')
            ->where(function($query) use ($idMotorista) {
                // Condiciones para los estados de los pedidos
                $query->whereIn('pedido.id_estado', [1, 6, 9]) // Mostrar todos los de estado 1 y 9
                ->orWhere(function($query) use ($idMotorista) {
                    // Para el estado 15, solo mostrar si el id_motorista es igual al logeado
                    $query->where('pedido.id_estado', 15)
                        ->where('pedido.id_motorista', $idMotorista);
                });
            })
            ->select('pedido.*', 'ubicacion.nombre', 'ubicacion.cod')
            ->paginate(5);

        return view('Motorista.entregasPendientes', compact('entrega'));
    }


    public function detallesPedidoMotorista($id_pedido){

        $pedido = Motorista::findOrFail($id_pedido);
        $cliente = Cliente::where('id_cliente', $pedido->id_cliente)->first();
        $estados = Estado::where('id_estado', $pedido->id_estado)->first();

        return view('Motorista.detallesPedido', compact('pedido','cliente','estados'));
    }

    public function estadoPedidoMotorista(Request $request, $id_pedido)
    {
        $pedido = Motorista::findOrFail($id_pedido);

        // Cambiar el estado según el botón presionado
        $pedido->id_estado = $request->estado;
        $usuario= Auth::guard('usuarios')->user(); //datos del usuario logeado
        $pedido->id_motorista = $usuario->id_usuario; //pide solo el id del usuario loegado
        $pedido->save();

        // Redirigir a la vista correspondiente según el estado
        if ($request->estado == 15) {
            return redirect()->route('detalles', ['id_pedido' => $id_pedido]);// Refresca la vista
        } elseif ($request->estado == 9) {
            return redirect('/entregas'); // Redirige a entregas
        } elseif ($request->estado == 2) {
            return redirect('/historial');
        }elseif ($request->estado == 7) {
            return redirect('/historial');
        }
    }


    public function historial()
    {
        // Obtener el id del usuario logeado
        $usuario = Auth::guard('usuarios')->user();
        $idMotorista = $usuario->id_usuario;

        $entrega = DB::table('motorista_historial')
            ->join('pedido', 'motorista_historial.id_pedido', '=', 'pedido.id_pedido')
            ->join('cliente', 'pedido.id_cliente', '=', 'cliente.id_cliente')
            ->join('ubicacion', 'cliente.id_ubicacion', '=', 'ubicacion.id_ubicacion')
            ->where('motorista_historial.id_motorista', $idMotorista) // Filtrar por el id del motorista
            ->select('motorista_historial.*', 'pedido.*', 'ubicacion.nombre', 'ubicacion.cod')
            ->paginate(3);

        return view('Motorista.historialEntregas', compact('entrega'));
    }

    public function historialDetallesPedido($id_historial){

        $historial = DB::table('motorista_historial')
            ->where('id_historial', $id_historial)
            ->first();

        if (!$historial) {
            return redirect()->back()->with('error', 'Historial no encontrado.');
        }

        $pedido = Motorista::findOrFail($historial->id_pedido);
        $cliente = Cliente::where('id_cliente', $pedido->id_cliente)->first();
        $estados = Estado::where('id_estado', $pedido->id_estado)->first();

        return view('Motorista.historialDetalleEntregas', compact('pedido', 'cliente', 'estados', 'historial'));
    }

}
