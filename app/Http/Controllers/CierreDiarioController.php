<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\CierreDiario;
use Illuminate\Http\Request;

class CierreDiarioController extends Controller
{
    public function index(){
        // Obtener la fecha actual
        $fechaActual = date('Y-m-d');

        // Obtener los pedidos del día actual
        $pedidos = Pedido::whereDate('fecha', $fechaActual)->get();

        // Calcular totales
        $totalPedidos = $pedidos->count();
        $totalIngresos = $pedidos->sum('total_servicio');
        $totalDetergente = $pedidos->sum('detergente');
        $totalSuavizante = $pedidos->sum('suavizante');

        return view('Lavanderia.Contabilidad.cierreDiario', compact('totalPedidos', 'totalIngresos', 'totalDetergente', 'totalSuavizante', 'fechaActual'));
    }

    public function store(Request $request){
        $request->validate([
            'energia_consumida' => 'required|numeric',
            'agua_consumida' => 'required|numeric',
            'gas_consumido' => 'required|numeric',
        ]);

        CierreDiario::create([
            'fecha' => date('Y-m-d'),
            'total_pedidos' => $request->total_pedidos,
            'total_ingresos' => $request->total_ingresos,
            'detergente_usado' => $request->detergente_usado,
            'suavizante_usado' => $request->suavizante_usado,
            'otros_insumos_usados' => 0,
            'energia_consumida' => $request->energia_consumida,
            'agua_consumida' => $request->agua_consumida,
            'gas_consumido' => $request->gas_consumido,
        ]);

        return redirect()->route('Conta')->with('success', 'Cierre diario guardado correctamente.');
    }

    public function historico(Request $request){
        // Obtener el mes seleccionado, si está vacío, usar el mes actual
        $mesSeleccionado = $request->input('month', date('Y-m'));

        // Filtrar los cierres por el mes seleccionado
        $cierres = CierreDiario::whereYear('fecha', date('Y', strtotime($mesSeleccionado)))
                    ->whereMonth('fecha', date('m', strtotime($mesSeleccionado)))
                    ->paginate(3)
                    ->appends(['month' => $mesSeleccionado]); // Mantener el mes en la paginación

        return view('Lavanderia.Contabilidad.cierreHistorico', compact('cierres', 'mesSeleccionado'));
    }



    public function detalle($id)
    {
        $cierre = CierreDiario::findOrFail($id); // Encuentra el cierre por ID
        return view('Lavanderia.Contabilidad.cierreDetalle', compact('cierre')); // Pasa el cierre a la vista
    }
}
