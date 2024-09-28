<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Lavanderia;
use App\Models\Pedido;
use App\Models\PrecioServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LavanderiaController extends Controller
{
    public function indexLavanderia()
    {
        return view('Lavanderia.menuLavanderia');
    }

    public function indexAdministrador()
    {
        return view('Lavanderia.menuAdministrador');
    }

    public function pedidos()
    {
        // Obtener el id del usuario logeado
        $usuario = Auth::guard('usuarios')->user();
        $idadmin = $usuario->id_usuario;

        $pedido = DB::table('pedido')
            ->join('cliente','pedido.id_cliente', '=', 'cliente.id_cliente')
            ->join('ubicacion', 'cliente.id_ubicacion', '=', 'ubicacion.id_ubicacion')
            ->whereIn('pedido.id_estado', [1, 9, 15]) // Filtrar por estados
            ->select('pedido.*', 'ubicacion.nombre','ubicacion.cod')
            ->paginate(5);

        return view('Lavanderia.pedidosespera', compact('pedido'));
    }

    public function detallesPedido($id_pedido){

        $pedido = Pedido::findOrFail($id_pedido); 
        $cliente = Cliente::where('id_cliente', $pedido->id_cliente)->first();
        $servicios = PrecioServicio::where('id_precio_serv', $pedido->id_precio_serv)->first();
        $estados = Estado::where('id_estado', $pedido->id_estado)->first();
 
        return view('Lavanderia.detallesPedido', compact('pedido','cliente','servicios','estados'));
    }

    public function estadoPedido(Request $request, $id_pedido)
    {
        // Encuentra el pedido por su ID
        $pedido = Pedido::findOrFail($id_pedido); // Asegúrate de usar el modelo correcto
    
        // Cambiar el estado según el botón presionado
        if ($request->has('estado')) {
            $pedido->id_estado = $request->estado; // Cambia el estado
            $usuario = Auth::guard('usuarios')->user(); // Obtiene los datos del usuario logeado
            $pedido->id_motorista = $usuario->id_usuario; // Guarda el ID del usuario logeado
            $pedido->save(); // Guarda los cambios
        }
    
        // Redirigir a la misma vista del pedido con el estado actualizado
        return redirect()->route('detallesPedido', $pedido->id_pedido);
    }

    public function calcularCanastos($id_pedido)
{
    // Lógica para manejar el pedido con el id proporcionado
    $pedido = Pedido::findOrFail($id_pedido); // Ejemplo de cómo obtener el pedido
    return view('Lavanderia.calcularCanastos', compact('pedido'));
}


    
}