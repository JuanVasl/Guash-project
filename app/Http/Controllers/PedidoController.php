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
use Illuminate\Support\Facades\Cache;

class PedidoController extends Controller
{
    public function inicioPedido(Request $request)
    {
        $userId = auth()->user()->id_cliente;

        // Genera una clave única para el usuario en caché
        $cacheKey = "user_{$userId}_pedido_count";
        $currentCount = Cache::get($cacheKey, 0);

        if ($currentCount >= 3) {
            return redirect()->back()->withErrors(['message' => 'Has alcanzado el límite de 3 pedidos por hora. Inténtalo más tarde.']);
        }

        if ($request->isMethod('post')) {
            $fecha = Carbon::now('America/Guatemala');
            $pedido = Pedido::create([
                'fecha' => $fecha,
                'id_cliente' => $userId,
                'programado' => 0,
                'id_estado' => 1,
            ]);

            // Incrementa el contador y establece el tiempo de expiración a 1 hora
            Cache::put($cacheKey, $currentCount + 1, now()->addHour());
        }

        return redirect()->route('pedidos.servicios', $pedido);
    }
    public function direccion($pedido)
    {
        $pedido = Pedido::findOrFail($pedido);
        $cliente = Cliente::findOrFail($pedido->id_cliente);
        $tiposDireccion = TipoDireccion::orderBy('id_tipo_direcc', 'asc')->get();
        $ubicaciones = Ubicacion::orderBy('id_ubicacion', 'asc')->get();

        // Obtener los valores actuales
        $tipo_direccion_actual = $cliente->id_tipo_direcc;
        $ubicacion_actual = $cliente->id_ubicacion;

        return view('pedidos.direccion', compact('tiposDireccion', 'ubicaciones', 'cliente', 'pedido', 'tipo_direccion_actual', 'ubicacion_actual'));
    }

    public function guardarDireccion(Request $request, $pedido)
    {
        // Validar los campos recibidos del formulario
        $request->validate([
            'id_tipo_direcc' => 'required|exists:tipo_direcc,id_tipo_direcc',
            'direccion' => 'required|string',
            'referencia' => 'required|string',
            'id_ubicacion' => 'required|exists:ubicacion,id_ubicacion'
        ]);

        // Obtener el pedido a partir del parámetro $pedido
        $pedido = Pedido::findOrFail($pedido);

        // Obtener el id_cliente desde el pedido
        $id_cliente = $pedido->id_cliente;

        // Buscar el cliente usando el id_cliente
        $cliente = Cliente::findOrFail($id_cliente);

        // Actualizar los campos del cliente
        $cliente->update([
            'id_ubicacion' => $request->id_ubicacion,
            'direccion' => $request->direccion,
            'referencia' => $request->referencia,
            'id_tipo_direcc' => $request->id_tipo_direcc
        ]);

        return redirect()->route('pedidos.resumen',$pedido);
    }

    public function servicios(Pedido $pedido)
    {
        // Filtrar los servicios que tengan vigencia = 1
        $servicios = PrecioServicio::where('vigencia', 1)
            ->orderBy('id_precio_serv', 'asc')
            ->get();
        return view('pedidos.servicio', compact('pedido', 'servicios'));
    }

    public function guardarServicios(Request $request, Pedido $pedido)
    {
        $request->validate([
            'id_precio_serv' => 'required|exists:precio_servicio,id_precio_serv',
        ]);

        $pedido->id_precio_serv = $request->id_precio_serv;

        $pedido->save();

        return redirect()->route('pedidos.direcc', ['pedido' => $pedido->id_pedido]);
    }

    public function resumen(Pedido $pedido)
    {
        $pedido->load('cliente.ubicacion', 'precioServicio');

        return view('pedidos.resumen', compact('pedido'));
    }

    public function eliminar(Pedido $pedido)
    {
        $pedido->delete();  // Elimina el pedido de la base de datos
        return redirect()->route('index');
    }
    public function historialPedidos(Request $request)
    {
        // Obtener el ID del cliente autenticado
        $clienteId = Auth::guard('web')->id(); // Obtiene el ID del cliente autenticado

        // Inicializa la consulta
        $pedidosQuery = Pedido::where('id_cliente', $clienteId);

        // Filtrar por fecha si se proporciona
        if ($request->filled('fecha')) {
            $fecha = $request->input('fecha');
            $pedidosQuery->whereDate('fecha', $fecha);
        }

        // Filtrar por estado si se proporciona
        if ($request->filled('estado')) {
            $estado = $request->input('estado');
            $pedidosQuery->where('id_estado', $estado);
        }

        // Obtener todos los pedidos del cliente autenticado ordenados por fecha descendente
        $pedidos = $pedidosQuery
            ->orderBy('fecha', 'desc')
            ->with('precioServicio', 'estado') // Carga anticipada de relaciones
            ->paginate(4); // Paginación

        return view('pedidos.historial', compact('pedidos'));
    }

    public function detallePedido($id_pedido)
    {
        // Obtener el ID del cliente autenticado
        $clienteId = Auth::guard('web')->id();

        // Obtener el pedido específico del cliente autenticado
        $pedido = Pedido::where('id_cliente', $clienteId)
            ->where('id_pedido', $id_pedido)
            ->with(['precioServicio', 'estado']) // Carga anticipada de relaciones
            ->first();

        // Verificar si el pedido existe
        if (!$pedido) {
            return redirect()->route('pedidos.historial')->with('error', 'Pedido no encontrado.');
        }

        return view('pedidos.detalle', compact('pedido'));
    }

    public function iniciarProgramacion(Request $request)
    {
        if ($request->isMethod('post')) {
            $idCliente = auth()->user()->id_cliente;
            $cacheKey = "user_{$idCliente}_programacion_count";

            // Obtiene el número actual de intentos de programación
            $currentCount = Cache::get($cacheKey, 0);

            if ($currentCount >= 3) {
                return redirect()->route('pedidos.programar')
                    ->with('error', 'Has alcanzado el límite de 3 intentos de programación por hora.');
            }

            // Incrementa el contador de intentos en el caché
            Cache::increment($cacheKey);
            Cache::put($cacheKey, $currentCount + 1, now()->addHour());

            // Crea el pedido programado
            $pedido = Pedido::create([
                'id_cliente' => $idCliente,
                'programado' => 1,
                'id_estado' => 1,
            ]);

            return redirect()->route('pedidos.programar', $pedido);
        }
    }

    public function programar(Pedido $pedido)
    {
        return view('pedidos.programar', compact('pedido'));
    }

    public function guardarProgramacion(Request $request, Pedido $pedido)
    {
        $request->validate([
            'fecha_programada' => 'required|date|after:now',
        ]);

        $pedido->update([
            'fecha' => $request->fecha_programada,
        ]);

        return redirect()->route('pedidos.servicios', $pedido);
    }
    public function verificarIntentosProgramacion()
    {
        $userId = auth()->user()->id_cliente;
        $cacheKey = "user_{$userId}_programacion_count";
        $currentCount = Cache::get($cacheKey, 0);
        $intentosRestantes = max(0, 3 - $currentCount);

        return response()->json(['intentos_restantes' => $intentosRestantes]);
    }
    public function verificarIntentos()
    {
        $userId = auth()->user()->id_cliente;
        $cacheKey = "user_{$userId}_pedido_count";
        $currentCount = Cache::get($cacheKey, 0);
        $intentosRestantes = max(0, 3 - $currentCount);

        return response()->json(['intentos_restantes' => $intentosRestantes]);
    }

}
