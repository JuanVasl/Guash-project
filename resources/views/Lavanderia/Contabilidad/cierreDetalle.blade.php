<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cierre Diario - PDF</title>
    <style>
        /* Colores y estilos básicos */
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f8f9fa; /* Fondo general */
            display: flex;
            justify-content: center; /* Centra el contenido */
            align-items: center; /* Alinea verticalmente */
            height: 100vh; /* Altura completa */
            margin: 0; /* Sin margen */
        }

        /* Encabezado */
        .header {
            background-color: #ffffff;
            color: #4A90E2;
            padding: 10px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between; /* Espacio entre el logo y el texto */
            max-width: 600px; /* Limita el ancho */
            width: 100%; /* Ancho completo */
        }

        .header h1 {
            color: #4A90E2;
            margin: 0; /* Elimina margen para un mejor alineamiento */
        }

        .header p {
            font-size: 20px;
            margin: 0; /* Elimina margen para un mejor alineamiento */
            color: #4A90E2; /* Asegúrate de que el texto sea visible */
        }

        h2 {
            color: #4A90E2;
            margin: 20px 0 10px; /* Espaciado para el encabezado */
            text-align: center; /* Centra el título */
        }

        /* Estilo de la tabla */
        .content-table {
            background-color: rgb(217, 217, 217);
            border-radius: 15px;
            padding: 20px; /* Espaciado alrededor de la tabla */
            max-width: 600px; /* Limitar el ancho de la tabla */
            margin: auto; /* Centrar la tabla */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0; /* Elimina margen */
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
            margin-top: 10px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>

    <!-- Encabezado -->
    <div class="header">
        <div style="text-align: center; flex-grow: 1;">
            <h1>Cierre del Día {{ $fechaCierre }}</h1>
            <p style="font-size: 20px;">Impreso Por: {{Auth::guard('usuarios')->user()->nombre_usuario}}</p>
        </div>
    </div>

    <div class="content-table">
        <!-- Detalles del Cierre -->
        <h2>Detalles del Cierre</h2>
        <table>
            <tr>
                <th>Total de Pedidos</th>
                <td>{{ $totalPedidos }}</td>
            </tr>
            <tr>
                <th>Total Ingresos (Q)</th>
                <td>Q{{ number_format($totalIngresos, 2) }}</td>
            </tr>
            <tr>
                <th>Detergente Usado (Copas)</th>
                <td>{{ $totalDetergente }} Copas</td>
            </tr>
            <tr>
                <th>Suavizante Usado (Copas)</th>
                <td>{{ $totalSuavizante }} Copas</td>
            </tr>
        </table>
        <!-- Recursos Consumidos -->
        <h2>Recursos Consumidos</h2>
        <table>
            <tr>
                <th>Energía Consumida (kWh)</th>
                <td>{{ $energiaConsumida }}</td>
            </tr>
            <tr>
                <th>Agua Consumida (Litros)</th>
                <td>{{ $aguaConsumida }}</td>
            </tr>
            <tr>
                <th>Gas Consumido (Libras)</th>
                <td>{{ $gasConsumido }}</td>
            </tr>
        </table>
    </div>

    <!-- Pie de Página -->
    <div class="footer">
        <p>&copy; {{ date('Y') }} Sistema de Lavandería - Cierre Diario</p>
    </div>

</body>
</html>
