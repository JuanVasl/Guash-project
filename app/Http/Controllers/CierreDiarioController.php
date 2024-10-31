<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pedido;
use App\Models\CierreDiario;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Lavanderia;
use App\Models\PrecioServicio;
use App\Models\Maquina;
use App\Models\Insumo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pdf;

class CierreDiarioController extends Controller{
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

    public function historicoPDF(Request $request){
        $month = $request->get('month', date('Y-m'));
        $cierres = CierreDiario::whereYear('fecha', date('Y', strtotime($month)))
                         ->whereMonth('fecha', date('m', strtotime($month)))
                         ->get();

        // Calcular totales
        $totalPedidos = $cierres->sum('total_pedidos');
        $totalIngresos = $cierres->sum('total_ingresos');
        $totalDetergente = $cierres->sum('detergente_usado');
        $totalSuavizante = $cierres->sum('suavizante_usado');
        $totalEnergia = $cierres->sum('energia_consumida');
        $totalAgua = $cierres->sum('agua_consumida');
        $totalGas = $cierres->sum('gas_consumido');

        // Obtener la fecha actual
        $fechaImpresion = now()->format('d/m/Y');

        // Crear el PDF
        $pdf = PDF::loadView('lavanderia.contabilidad.mesHistorico', [
            'month' => $month,
            'cierres' => $cierres,
            'totalPedidos' => $totalPedidos,
            'totalIngresos' => $totalIngresos,
            'totalDetergente' => $totalDetergente,
            'totalSuavizante' => $totalSuavizante,
            'totalEnergia' => $totalEnergia,
            'totalAgua' => $totalAgua,
            'totalGas' => $totalGas,
            'fechaImpresion' => $fechaImpresion,
        ])->setPaper('a4', 'landscape');

        return $pdf->download('cirres_de' . date('F_Y', strtotime($month)) . '.pdf');
    }

    public function detallePDF($id){
        // Recupera el cierre diario específico por ID
        $cierre = CierreDiario::findOrFail($id);

        // Variables para la vista
        $fechaCierre = Carbon::parse($cierre->fecha)->format('d-m-Y'); // Formatea la fecha
        $totalPedidos = $cierre->total_pedidos;
        $totalIngresos = $cierre->total_ingresos;
        $totalDetergente = $cierre->detergente_usado;
        $totalSuavizante = $cierre->suavizante_usado;
        $energiaConsumida = $cierre->energia_consumida;
        $aguaConsumida = $cierre->agua_consumida;
        $gasConsumido = $cierre->gas_consumido;

        // Cargar la vista para el PDF
        $pdf = PDF::loadView('Lavanderia.Contabilidad.cierreDetalle', compact(
            'cierre',
            'fechaCierre',
            'totalPedidos',
            'totalIngresos',
            'totalDetergente',
            'totalSuavizante',
            'energiaConsumida',
            'aguaConsumida',
            'gasConsumido'
        ));

        // Devuelve el PDF como descarga
        return $pdf->download('cierre_diario_' . $fechaCierre . '.pdf');
    }

}
