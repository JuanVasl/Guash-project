<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Lavanderia;
use App\Models\Pedido;
use App\Models\PrecioServicio;
use App\Models\Maquina;
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
            ->whereIn('pedido.id_estado', [2, 3, 4, 5, 6]) // Filtrar por estados
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

    //------------------------------------------------------------------- Apartado del calculo de Canastos -------------------------------------------------------------------
    public function calcularCanastos($id_pedido)
    {
        // Obtener el pedido con el precio del servicio relacionado
        $pedido = Pedido::with('precioServicio')->findOrFail($id_pedido);

        // Pasar el pedido a la vista
        return view('Lavanderia.calcularCanastos', compact('pedido'));
    }

    public function guardarCanastos(Request $request, $id_pedido)
    {
        // Valida la entrada
        $request->validate([
            'cant_canasto' => 'required|integer|min:1',
            'total_servicio' => 'required|numeric|min:0',
        ]);

        // Encuentra el pedido
        $pedido = Pedido::findOrFail($id_pedido);

        // Actualiza los campos de cantidad y total en el pedido
        $pedido->cant_canasto = $request->cant_canasto;
        $pedido->total_servicio = $request->total_servicio;

        // Guarda los cambios en la base de datos
        $pedido->save();

        // Redirige a la vista de detalles del pedido con un mensaje de éxito
        return redirect()->route('detallesPedido', ['id_pedido' => $pedido->id_pedido]);
    }


    public function equiposLavanderia()
{
    return view('Lavanderia.equiposLavanderia');
}

// Funcion de Lavadoras

    public function lavadoras()
{
    $lavadora = DB::table('maquina')
        ->join('estado', 'maquina.estado_id_estado', '=', 'estado.id_estado')
        ->join('tipo_maquina', 'maquina.id_tipo', '=', 'tipo_maquina.id_tipo')
        ->where('maquina.id_tipo', 1) // Mostrar solo las lavadoras (id_tipo = 1)
        ->select('maquina.id_maquina', 'estado.estado', 'capacidad')
        ->paginate(3);

    return view('Lavanderia.lavadoras', compact('lavadora'));
}

public function createLavadora() {
    return view('Lavanderia.crearLavadora');
}

public function saveLavadora(Request $request   ) {
    // Validación del formulario
    $request->validate([
        'modelo' => 'required|string|max:45',
        'marca' => 'required|string|max:45',
        'serie' => 'required|string|max:45',
        'capacidad' => 'required|integer',
    ]);

    // Crear una nueva lavadora en la base de datos
    $lavadora = Maquina::create([
        'id_tipo' => 1, // Valor fijo
        'modelo' => $request->modelo,
        'marca' => $request->marca,
        'serie' => $request->serie,
        'capacidad' => $request->capacidad,
        'estado_id_estado' => 10, // Valor fijo
    ]);

    return redirect()->back();

}

    public function detalleLavadoras($id)
{
    $lavadora = DB::table('maquina')
        ->join('estado', 'maquina.estado_id_estado', '=', 'estado.id_estado')
        ->join('tipo_maquina', 'maquina.id_tipo', '=', 'tipo_maquina.id_tipo')
        ->where('maquina.id_maquina', $id)
        ->select('maquina.*', 'estado.estado as nombre_estado')
        ->first();

    // Posibles estados para la lavadora
    $estados = DB::table('estado')->whereIn('id_estado', [10, 12, 13, 14])->get();

    return view('Lavanderia.detalleLavadoras', compact('lavadora', 'estados'));
}

    public function actualizarEstadoLavadora(Request $request, $id)
{
    // Validar el estado
    $request->validate([
        'estado_id_estado' => 'required|integer|exists:estado,id_estado',
    ]);

    // Actualizar el estado de la lavadora
    DB::table('maquina')
        ->where('id_maquina', $id)
        ->update(['estado_id_estado' => $request->estado_id_estado]);

    return redirect()->back()->with('success', 'El estado de la lavadora ha sido actualizado correctamente.');
}

//Funcion de Secadoras

public function secadoras()
{
    $secadora = DB::table('maquina')
        ->join('estado', 'maquina.estado_id_estado', '=', 'estado.id_estado')
        ->join('tipo_maquina', 'maquina.id_tipo', '=', 'tipo_maquina.id_tipo')
        ->where('maquina.id_tipo', 2) // Mostrar solo las lavadoras (id_tipo = 2)
        ->select('maquina.id_maquina', 'estado.estado', 'capacidad')
        ->paginate(3);

    return view('Lavanderia.secadoras', compact('secadora'));
}

public function createSecadora() {

    return view('Lavanderia.crearSecadora');

}

public function saveSecadora(Request $request   ) {
    // Validación del formulario
    $request->validate([
        'modelo' => 'required|string|max:45',
        'marca' => 'required|string|max:45',
        'serie' => 'required|string|max:45',
        'capacidad' => 'required|integer',
    ]);

    // Crear una nueva Secadora en la base de datos
    $lavadora = Maquina::create([
        'id_tipo' => 2, // Valor fijo
        'modelo' => $request->modelo,
        'marca' => $request->marca,
        'serie' => $request->serie,
        'capacidad' => $request->capacidad,
        'estado_id_estado' => 10, // Valor fijo
    ]);

    return redirect()->back();

}

    public function detalleSecadoras($id)
{
    $secadora = DB::table('maquina')
        ->join('estado', 'maquina.estado_id_estado', '=', 'estado.id_estado')
        ->join('tipo_maquina', 'maquina.id_tipo', '=', 'tipo_maquina.id_tipo')
        ->where('maquina.id_maquina', $id)
        ->select('maquina.*', 'estado.estado as nombre_estado')
        ->first();

    // Posibles estados para la Secadora
    $estados = DB::table('estado')->whereIn('id_estado', [10, 12, 13, 14])->get();

    return view('Lavanderia.detalleSecadoras', compact('secadora', 'estados'));
}

    public function actualizarEstadoSecadora(Request $request, $id)
{
    // Validar el estado
    $request->validate([
        'estado_id_estado' => 'required|integer|exists:estado,id_estado',
    ]);

    // Actualizar el estado de la Secadora
    DB::table('maquina')
        ->where('id_maquina', $id)
        ->update(['estado_id_estado' => $request->estado_id_estado]);

    return redirect()->back()->with('success', 'El estado de la Secadora ha sido actualizado correctamente.');
}

/* ----------------------------------------------------------------------------- Asignación de Equipos -----------------------------------------------------------------------------*/

public function asignarEquipos($id_pedido) {
    $pedido = Pedido::findOrFail($id_pedido);

    // Obtener el tipo de máquina por id_tipo
    $lavadora = DB::table('maquina')->where('maquina.id_tipo', 1)->get(); // 1 para Lavadora
    $secadora = DB::table('maquina')->where('maquina.id_tipo', 2)->get(); // 2 para Secadora



    switch ($pedido->id_precio_serv) {
        case 1: // Asignar Lavadora
            return view('Lavanderia.asignarLavadora', compact('pedido', 'lavadora'));
        case 2: // Asignar Secadora
            return view('Lavanderia.asignarSecadora', compact('pedido', 'secadora'));
        case 3: // Asignar Lavadora y Secadora
            return view('Lavanderia.asignarLavadoraSecadora', compact('pedido', 'lavadora', 'secadora'));
        default:
            return redirect('/pedidos')->with('error', 'Estado no válido para asignación de equipos.');
    }
}

public function guardarAsignacionLavadora(Request $request, $id_pedido) {
    $pedido = Pedido::findOrFail($id_pedido);

    // Validar que se haya seleccionado una lavadora
    $request->validate([
        'id_maquina' => 'required|exists:maquina,id_maquina',
    ]);

    // Guardar la asignación de la máquina
    DB::table('asignacion_maquina')->insert([
        'id_pedido' => $id_pedido,
        'id_maquina' => $request->id_maquina // Asegúrate que aquí recibas el id correcto
    ]);

    return redirect()->route('detallesPedido', $id_pedido)->with('success', 'Lavadora asignada exitosamente.');
}

public function guardarAsignacionSecadora(Request $request, $id_pedido) {
    $pedido = Pedido::findOrFail($id_pedido);

    // Validar que se haya seleccionado una secadora
    $request->validate([
        'id_secadora' => 'required|exists:maquina,id_maquina',
    ]);

    // Guardar la asignación de la secadora
    DB::table('asignacion_maquina')->insert([
        'id_pedido' => $id_pedido,
        'id_maquina' => $request->id_secadora,
    ]);

    return redirect()->route('detallesPedido', $id_pedido)->with('success', 'Secadora asignada exitosamente.');
}

public function guardarAsignacionLavadoraSecadora(Request $request, $id_pedido) {
    $pedido = Pedido::findOrFail($id_pedido);

    // Validar que se hayan seleccionado una lavadora y una secadora
    $request->validate([
        'id_lavadora' => 'required|exists:maquina,id_maquina',
        'id_secadora' => 'required|exists:maquina,id_maquina',
    ]);

    // Guardar la asignación de la lavadora
    DB::table('asignacion_maquina')->insert([
        'id_pedido' => $id_pedido,
        'id_maquina' => $request->id_lavadora,
    ]);

    // Guardar la asignación de la secadora
    DB::table('asignacion_maquina')->insert([
        'id_pedido' => $id_pedido,
        'id_maquina' => $request->id_secadora,
    ]);

    return redirect()->route('detallesPedido', $id_pedido)->with('success', 'Lavadora y secadora asignadas exitosamente.');
}


//Menu de Contabilidad para Lavanderia
public function menuContabilidad(){
        return view('Lavanderia.contabilidad');
    }



}
