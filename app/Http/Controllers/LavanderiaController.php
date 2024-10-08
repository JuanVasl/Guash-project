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
        ->where('maquina.id_tipo', 2) // Mostrar solo las lavadoras (id_tipo = 1)
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

//Funcion para asignar equipos

public function asignarEquipo($id_pedido)
{
    // Obtener el pedido y su tipo de servicio
    $pedido = Pedido::find($id_pedido);
    
    // Filtrar las máquinas por estado disponible (por ejemplo, estado_id_estado = 10 es 'disponible')
    $lavadorasDisponibles = Maquina::where('id_tipo', 1)
                        ->where('estado_id_estado', 10)
                        ->get();
                        
    $secadorasDisponibles = Maquina::where('id_tipo', 2)
                        ->where('estado_id_estado', 10)
                        ->get();
    
    // Determinar qué vista y qué datos enviar
    if ($pedido->tipo_servicio == 'lavado') {
        // Solo permitir la selección de lavadora
        return view('Lavanderia.asignarLavadora', compact('lavadorasDisponibles', 'pedido'));
    } elseif ($pedido->tipo_servicio == 'secado') {
        // Solo permitir la selección de secadora
        return view('Lavanderia.asignarSecadora', compact('secadorasDisponibles', 'pedido'));
    } else {
        // Permitir la selección de lavadora y secadora
        return view('Lavanderia.asignarLavadoraSecadora', compact('lavadorasDisponibles', 'secadorasDisponibles', 'pedido'));
    }
}

public function guardarAsignacionLavadora(Request $request, $id_pedido)
{
    // Validar la entrada
    $request->validate([
        'id_lavadora' => 'required|exists:maquina,id_maquina',
    ]);

    // Obtener el pedido y asignar la lavadora
    $pedido = Pedido::findOrFail($id_pedido);
    $pedido->id_lavadora = $request->id_lavadora; // Asegúrate de que existe el campo en tu modelo Pedido
    $pedido->save();

    return redirect()->route('pedidos')->with('success', 'Lavadora asignada correctamente.');
}

public function guardarAsignacionSecadora(Request $request, $id_pedido)
{
    // Validar la entrada
    $request->validate([
        'id_secadora' => 'required|exists:maquina,id_maquina',
    ]);

    // Obtener el pedido y asignar la secadora
    $pedido = Pedido::findOrFail($id_pedido);
    $pedido->id_secadora = $request->id_secadora; // Asegúrate de que existe el campo en tu modelo Pedido
    $pedido->save();

    return redirect()->route('pedidos')->with('success', 'Secadora asignada correctamente.');
}

public function guardarAsignacionLavadoraSecadora(Request $request, $id_pedido)
{
    // Validar la entrada
    $request->validate([
        'id_lavadora' => 'required|exists:maquina,id_maquina',
        'id_secadora' => 'required|exists:maquina,id_maquina',
    ]);

    // Obtener el pedido y asignar la lavadora y secadora
    $pedido = Pedido::findOrFail($id_pedido);
    $pedido->id_lavadora = $request->id_lavadora; // Asegúrate de que existe el campo en tu modelo Pedido
    $pedido->id_secadora = $request->id_secadora; // Asegúrate de que existe el campo en tu modelo Pedido
    $pedido->save();

    // Redirigir a la vista de confirmación del lavado
    return view('Lavanderia.lavadoCompletado', compact('pedido'));
}



















//Menu de Contabilidad para Lavanderia
public function menuContabilidad()
    {
        return view('Lavanderia.contabilidad');
    }



}
