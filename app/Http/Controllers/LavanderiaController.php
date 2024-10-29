<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Lavanderia;
use App\Models\Pedido;
use App\Models\PrecioServicio;
use App\Models\Maquina;
use App\Models\Insumo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pdf;

class LavanderiaController extends Controller{

    /*-------------------- Vista Principales --------------------*/
    public function indexLavanderia(){
        return view('Lavanderia.menuLavanderia');
    }

    public function indexAdministrador(){
        return view('Lavanderia.menuAdministrador');
    }

    /*-------------------- Trabajando con Pedidos --------------------*/
    public function pedidos(){
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
        // Obtener el pedido por ID
        $pedido = Pedido::findOrFail($id_pedido);

        // Obtener el cliente y el servicio
        $cliente = Cliente::where('id_cliente', $pedido->id_cliente)->first();
        $servicios = PrecioServicio::where('id_precio_serv', $pedido->id_precio_serv)->first();
        $estados = Estado::where('id_estado', $pedido->id_estado)->first();

        // Obtener la lavadora asignada
        $lavadoraAsignada = DB::table('asignacion_maquina')
            ->join('maquina', 'asignacion_maquina.id_maquina', '=', 'maquina.id_maquina')
            ->where('asignacion_maquina.id_pedido', $pedido->id_pedido)
            ->where('maquina.id_tipo', 1) // Cambia a la ID correspondiente para Lavadora
            ->select('maquina.id_maquina', 'maquina.marca', 'maquina.capacidad')
            ->first();

        // Obtener la secadora asignada
        $secadoraAsignada = DB::table('asignacion_maquina')
            ->join('maquina', 'asignacion_maquina.id_maquina', '=', 'maquina.id_maquina')
            ->where('asignacion_maquina.id_pedido', $pedido->id_pedido)
            ->where('maquina.id_tipo', 2) // Cambia a la ID correspondiente para Secadora
            ->select('maquina.id_maquina', 'maquina.marca', 'maquina.capacidad')
            ->first();

        // Pasar las máquinas asignadas a la vista
        return view('Lavanderia.detallesPedido', compact('pedido', 'cliente', 'servicios', 'estados', 'lavadoraAsignada', 'secadoraAsignada'));
    }

    public function estadoPedido(Request $request, $id_pedido){
        // Encuentra el pedido por su ID
        $pedido = Pedido::findOrFail($id_pedido);

        // Cambiar el estado según el botón presionado
        if ($request->has('estado')) {
            $pedido->id_estado = $request->estado; // Cambia el estado
            $usuario = Auth::guard('usuarios')->user(); // Obtiene los datos del usuario logeado
            $pedido->id_lavandero = $usuario->id_usuario; // Guarda el ID del usuario logeado

            // Si el estado es 4 ("Comenzar Lavado"), resta los insumos y actualiza el pedido
            if ($request->estado == 4) {
                // Calcular cantidad de detergente y suavizante a restar según canastos
                $cant_canasto = $pedido->cant_canasto;
                $cantidad_a_restar = intval(ceil($cant_canasto / 2));

                // Obtener los insumos
                $detergente = Insumo::where('nombre_insumo', 'detergente')->first();
                $suavizante = Insumo::where('nombre_insumo', 'suavizante')->first();

                if ($detergente && $suavizante) {
                    // Restar los insumos y guardar los cambios en la base de datos
                    $detergente->cantidad_disponible -= $cantidad_a_restar;
                    $suavizante->cantidad_disponible -= $cantidad_a_restar;
                    $detergente->save();
                    $suavizante->save();

                    // Guardar la cantidad utilizada en el pedido
                    $pedido->detergente = $cantidad_a_restar;
                    $pedido->suavizante = $cantidad_a_restar;
                }
            }

            $pedido->save(); // Guarda los cambios en el pedido
        }

        // Redirigir a la misma vista del pedido con el estado actualizado
        return redirect()->route('detallesPedido', $pedido->id_pedido);
    }


    public function calcularCanastos($id_pedido){
        // Obtener el pedido con el precio del servicio relacionado
        $pedido = Pedido::with('precioServicio')->findOrFail($id_pedido);

        // Pasar el pedido a la vista
        return view('Lavanderia.calcularCanastos', compact('pedido'));
    }

    public function guardarCanastos(Request $request, $id_pedido){
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

    /*-------------------- Maquinas de Laavanderia --------------------*/
    public function equiposLavanderia(){
        return view('Lavanderia.Maquinas.equiposLavanderia');
    }

    // 1. Funcion de Lavadoras
    public function lavadoras(){
        $lavadora = DB::table('maquina')
            ->join('estado', 'maquina.estado_id_estado', '=', 'estado.id_estado')
            ->join('tipo_maquina', 'maquina.id_tipo', '=', 'tipo_maquina.id_tipo')
            ->where('maquina.id_tipo', 1) // Mostrar solo las lavadoras (id_tipo = 1)
            ->select('maquina.id_maquina', 'estado.estado', 'capacidad')
            ->paginate(3);

        return view('Lavanderia.Maquinas.lavadoras', compact('lavadora'));
    }

    public function createLavadora() {
        return view('Lavanderia.Maquinas.crearLavadora');
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

    public function detalleLavadoras($id){
        $lavadora = DB::table('maquina')
            ->join('estado', 'maquina.estado_id_estado', '=', 'estado.id_estado')
            ->join('tipo_maquina', 'maquina.id_tipo', '=', 'tipo_maquina.id_tipo')
            ->where('maquina.id_maquina', $id)
            ->select('maquina.*', 'estado.estado as nombre_estado')
            ->first();

        // Posibles estados para la lavadora
        $estados = DB::table('estado')->whereIn('id_estado', [10, 12, 13, 14])->get();

        return view('Lavanderia.Maquinas.detalleLavadoras', compact('lavadora', 'estados'));
    }

    public function actualizarEstadoLavadora(Request $request, $id){
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

    // 2. Funcion de Lavadoras
    public function secadoras(){
        $secadora = DB::table('maquina')
            ->join('estado', 'maquina.estado_id_estado', '=', 'estado.id_estado')
            ->join('tipo_maquina', 'maquina.id_tipo', '=', 'tipo_maquina.id_tipo')
            ->where('maquina.id_tipo', 2) // Mostrar solo las lavadoras (id_tipo = 2)
            ->select('maquina.id_maquina', 'estado.estado', 'capacidad')
            ->paginate(3);

        return view('Lavanderia.Maquinas.secadoras', compact('secadora'));
    }

    public function createSecadora() {
        return view('Lavanderia.Maquinas.crearSecadora');
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

    public function detalleSecadoras($id){
        $secadora = DB::table('maquina')
            ->join('estado', 'maquina.estado_id_estado', '=', 'estado.id_estado')
            ->join('tipo_maquina', 'maquina.id_tipo', '=', 'tipo_maquina.id_tipo')
            ->where('maquina.id_maquina', $id)
            ->select('maquina.*', 'estado.estado as nombre_estado')
            ->first();

        // Posibles estados para la Secadora
        $estados = DB::table('estado')->whereIn('id_estado', [10, 12, 13, 14])->get();

        return view('Lavanderia.Maquinas.detalleSecadoras', compact('secadora', 'estados'));
    }

    public function actualizarEstadoSecadora(Request $request, $id){
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

    /*-------------------- Asignación de Maquinas a Pedidos --------------------*/
    public function asignarEquipos($id_pedido) {
        $pedido = Pedido::findOrFail($id_pedido);

        // Obtener el tipo de máquina por id_tipo
        $lavadora = DB::table('maquina')->where('maquina.id_tipo', 1)->get(); // 1 para Lavadora
        $secadora = DB::table('maquina')->where('maquina.id_tipo', 2)->get(); // 2 para Secadora

        switch ($pedido->id_precio_serv) {
            case 1: // Asignar Lavadora
                return view('Lavanderia.Maquinas.asignarLavadora', compact('pedido', 'lavadora'));
            case 2: // Asignar Secadora
                return view('Lavanderia.Maquinas.asignarSecadora', compact('pedido', 'secadora'));
            case 3: // Asignar Lavadora y Secadora
                return view('Lavanderia.Maquinas.asignarLavadoraSecadora', compact('pedido', 'lavadora', 'secadora'));
            default:
                return redirect('/pedidos')->with('error', 'Estado no válido para asignación de equipos.');
        }
    }

    public function guardarAsignacionLavadora(Request $request, $id_pedido) {
        $pedido = Pedido::findOrFail($id_pedido);

        // Validación de lavadora
        $request->validate([
            'id_maquina' => 'required|exists:maquina,id_maquina',
        ]);

        // Eliminar asignación previa de lavadora
        DB::table('asignacion_maquina')
            ->where('id_pedido', $id_pedido)
            ->whereIn('id_maquina', function($query) {
                $query->select('id_maquina')->from('maquina')->where('id_tipo', 1);
            })->delete();

        // Insertar asignación de lavadora
        DB::table('asignacion_maquina')->insert([
            'id_pedido' => $id_pedido,
            'id_maquina' => $request->id_maquina
        ]);

        return redirect()->route('detallesPedido', $id_pedido)->with('success', 'Lavadora asignada exitosamente.');
    }

    public function guardarAsignacionSecadora(Request $request, $id_pedido) {
        $pedido = Pedido::findOrFail($id_pedido);

        // Validación de secadora
        $request->validate([
            'id_maquina' => 'required|exists:maquina,id_maquina',
        ]);

        // Eliminar asignación previa de secadora
        DB::table('asignacion_maquina')
            ->where('id_pedido', $id_pedido)
            ->whereIn('id_maquina', function($query) {
                $query->select('id_maquina')->from('maquina')->where('id_tipo', 2);
            })->delete();

        // Insertar asignación de secadora
        DB::table('asignacion_maquina')->insert([
            'id_pedido' => $id_pedido,
            'id_maquina' => $request->id_maquina
        ]);

        return redirect()->route('detallesPedido', $id_pedido)->with('success', 'Secadora asignada exitosamente.');
    }

    public function guardarAsignacionLavadoraSecadora(Request $request, $id_pedido) {
        $pedido = Pedido::findOrFail($id_pedido);

        // Validación de lavadora y secadora
        $request->validate([
            'id_lavadora' => 'required|exists:maquina,id_maquina',
            'id_secadora' => 'required|exists:maquina,id_maquina',
        ]);

        // Eliminar asignación previa de lavadora y secadora
        DB::table('asignacion_maquina')
            ->where('id_pedido', $id_pedido)
            ->whereIn('id_maquina', function($query) {
                $query->select('id_maquina')->from('maquina')->whereIn('id_tipo', [1, 2]);
            })->delete();

        // Insertar asignación de lavadora y secadora
        DB::table('asignacion_maquina')->insert([
            ['id_pedido' => $id_pedido, 'id_maquina' => $request->id_lavadora],
            ['id_pedido' => $id_pedido, 'id_maquina' => $request->id_secadora],
        ]);

        return redirect()->route('detallesPedido', $id_pedido)->with('success', 'Lavadora y Secadora asignadas exitosamente.');
    }

    /*-------------------- Historial de los Pedidos --------------------*/
    public function historialPedidos(Request $request){
        // Obtener la fecha de la solicitud o usar la fecha de hoy por defecto
        $fecha = $request->input('fecha', now()->format('Y-m-d'));

        // Obtener los pedidos con estado 7 y la fecha proporcionada
        $pedidos = Pedido::where('id_estado', 7)
                        ->whereDate('fecha', $fecha)
                        ->paginate(3);

        // Pasar los pedidos y la fecha actual a la vista
        return view('Lavanderia.Historial.historialPedidos', compact('pedidos', 'fecha'));
    }

    public function detallePedidoHistorico($id) {
        $pedido = Pedido::with(['cliente', 'precioServicio', 'estado'])
                        ->findOrFail($id); // Usar findOrFail para manejar pedidos no encontrados

        $cliente = $pedido->cliente;
        $servicios = $pedido->precioServicio;
        $estados = $pedido->estado;

        // Obtener la lavadora asignada
        $lavadoraAsignada = DB::table('asignacion_maquina')
            ->join('maquina', 'asignacion_maquina.id_maquina', '=', 'maquina.id_maquina')
            ->where('asignacion_maquina.id_pedido', $pedido->id_pedido)
            ->where('maquina.id_tipo', 1) // Cambia a la ID correspondiente para Lavadora
            ->select('maquina.id_maquina', 'maquina.marca', 'maquina.capacidad')
            ->first();

        // Obtener la secadora asignada
        $secadoraAsignada = DB::table('asignacion_maquina')
            ->join('maquina', 'asignacion_maquina.id_maquina', '=', 'maquina.id_maquina')
            ->where('asignacion_maquina.id_pedido', $pedido->id_pedido)
            ->where('maquina.id_tipo', 2) // Cambia a la ID correspondiente para Secadora
            ->select('maquina.id_maquina', 'maquina.marca', 'maquina.capacidad')
            ->first();

        return view('Lavanderia.Historial.detallePedidoHistorico', compact('pedido', 'cliente', 'servicios', 'estados', 'lavadoraAsignada', 'secadoraAsignada'));
    }

    public function exportarPedidoPDF($id_pedido){
        // Obtener datos del pedido y relaciones necesarias
        $pedido = Pedido::findOrFail($id_pedido);
        $cliente = $pedido->cliente;
        $servicios = $pedido->precioServicio;
        $lavadoraAsignada = $pedido->lavadoraAsignada ?? null;
        $secadoraAsignada = $pedido->secadoraAsignada ?? null;

         // Obtener la lavadora asignada
         $lavadoraAsignada = DB::table('asignacion_maquina')
         ->join('maquina', 'asignacion_maquina.id_maquina', '=', 'maquina.id_maquina')
         ->where('asignacion_maquina.id_pedido', $pedido->id_pedido)
         ->where('maquina.id_tipo', 1) // Cambia a la ID correspondiente para Lavadora
         ->select('maquina.id_maquina', 'maquina.marca', 'maquina.capacidad')
         ->first();

     // Obtener la secadora asignada
     $secadoraAsignada = DB::table('asignacion_maquina')
         ->join('maquina', 'asignacion_maquina.id_maquina', '=', 'maquina.id_maquina')
         ->where('asignacion_maquina.id_pedido', $pedido->id_pedido)
         ->where('maquina.id_tipo', 2) // Cambia a la ID correspondiente para Secadora
         ->select('maquina.id_maquina', 'maquina.marca', 'maquina.capacidad')
         ->first();

        // Generar el PDF usando la vista correcta
        $pdf = PDF::loadView('Lavanderia.Historial.pedido_pdf', compact('pedido', 'cliente', 'servicios', 'lavadoraAsignada', 'secadoraAsignada'));

        // Retornar el PDF descargable
        return $pdf->download('Pedido_'.$id_pedido.'.pdf');
    }

    /*-------------------- Vista de Reporteria Contable --------------------*/
    public function menuContabilidad(){
        return view('Lavanderia.Contabilidad.contabilidad');
    }

    public function insumos(){
        // Obtener todos los insumos
        $insumos = Insumo::all();

        return view('Lavanderia.Contabilidad.insumos', compact('insumos'));
    }

    // Método para agregar cantidades a múltiples insumos
    public function agregarCantidad(Request $request){
        $cantidades = $request->input('cantidades', []);

        foreach ($cantidades as $id => $cantidadAgregar) {
            if ($cantidadAgregar && $cantidadAgregar > 0) {
                $insumo = Insumo::findOrFail($id);
                $insumo->cantidad_disponible += $cantidadAgregar;
                $insumo->save();
            }
        }

        session()->flash('success', 'Cantidades agregadas correctamente');
        return redirect()->route('inventario.insumos');
    }


}
