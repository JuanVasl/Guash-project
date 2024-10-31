<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cierre del Mes {{ date('F', strtotime($month)) }} - PDF</title>
    <style>
        /* Colores y estilos básicos */
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f8f9fa; /* Fondo general */
        }

        h1, h2 {
            color: #4A90E2;
            text-align: center; /* Centra los títulos */
        }

        /* Estilo de la tabla */
        .content-table {
            background-color: rgb(217, 217, 217);
            border-radius: 15px;
            padding: 20px; /* Espaciado alrededor de la tabla */
            margin: auto; /* Centrar la tabla */
            max-width: 800px; /* Limitar el ancho de la tabla */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0; /* Espaciado alrededor de la tabla */
        }

        th {
            background-color: #4A90E2;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }

        td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>

    <h1>Cierres de {{ date('F Y', strtotime($month)) }}</h1>
    <h2>Impreso Por: {{Auth::guard('usuarios')->user()->nombre_usuario}} el: {{ $fechaImpresion }}</h2>

    <div class="content-table">
        <table>
            <thead>
                <tr>
                    <th>Dia</th>
                    <th>Pedidos</th>
                    <th>Ingresos (Q)</th>
                    <th>Detergente Usado (Copas)</th>
                    <th>Suavizante Usado (Copas)</th>
                    <th>Energía Consumida (kWh)</th>
                    <th>Agua Consumida (Litros)</th>
                    <th>Gas Consumido (Libras)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cierres as $cierre)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($cierre->fecha)->format('d') }}</td>
                        <td>{{ $cierre->total_pedidos }}</td>
                        <td>{{ $cierre->total_ingresos }}</td>
                        <td>{{ $cierre->detergente_usado }}</td>
                        <td>{{ $cierre->suavizante_usado }}</td>
                        <td>{{ $cierre->energia_consumida }}</td>
                        <td>{{ $cierre->agua_consumida }}</td>
                        <td>{{ $cierre->gas_consumido }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Total</th>
                    <th>{{ $totalPedidos }}</th>
                    <th>{{ $totalIngresos }}</th>
                    <th>{{ $totalDetergente }}</th>
                    <th>{{ $totalSuavizante }}</th>
                    <th>{{ $totalEnergia }}</th>
                    <th>{{ $totalAgua }}</th>
                    <th>{{ $totalGas }}</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="footer">
        <p>&copy; {{ date('Y') }} Sistema de Lavandería - Cierres del Mes</p>
    </div>

</body>
</html>
