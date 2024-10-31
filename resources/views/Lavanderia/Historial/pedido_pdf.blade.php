<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Pedido - PDF</title>
    <style>
        /* Colores y estilos básicos */
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f8f9fa;
        }

        /* Encabezado */
        .header {
            background-color: #ffffff;
            color: #4A90E2;
            padding: 10px 20px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: space-between; /* Espacio entre el logo y el texto */
        }

        .header img {
            width: 100px;
            height: auto;
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
            margin: 0;
        }

        /* Estilo de la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th {
            background-color: #4A90E2;
            color: white;
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

        /* Pie de Página */
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #666;
        }

        /* Estilo adicional para el contenedor */
        .container {
            text-align: center;
            width: 100%;
            max-width: 600px; /* Limitar el ancho de la tabla */
            margin: 0 auto; /* Centrar el contenedor */
            background-color: rgb(217, 217, 217);
            border-radius: 15px;
            padding: 20px;
        }
    </style>
</head>
<body>

    <!-- Encabezado -->
    <div class="header">
        <div style="text-align: center; flex-grow: 1;">
            <<h1><strong>Detalles de Pedido #{{ $pedido->id_pedido }}</strong></h1>
            <h2>Impreso Por: {{Auth::guard('usuarios')->user()->nombre_usuario}}</h2>
            <p>Fecha: {{ \Carbon\Carbon::parse($pedido->fecha)->format('d/m/y') }}</p>
        </div>
    </div>

    <!-- Contenido de Detalles del Pedido -->
    <div class="container">
                <table>
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Detalles</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Dirección:</strong></td>
                    <td>{{ $cliente->direccion }}, {{ $cliente->referencia }}</td>
                </tr>
                <tr>
                    <td><strong>Cliente:</strong></td>
                    <td>{{ $cliente->nombre_cliente }} {{ $cliente->apellido_cliente }}</td>
                </tr>
                <tr>
                    <td><strong>Teléfono:</strong></td>
                    <td>{{ $cliente->tele_cliente }}</td>
                </tr>
                <tr>
                    <td><strong>Servicio:</strong></td>
                    <td>{{ $servicios->servicio }}</td>
                </tr>
                <tr>
                    <td><strong>Canastos:</strong></td>
                    <td>{{ $pedido->cant_canasto }}</td>
                </tr>
                <tr>
                    <td><strong>Cobro de Servicio:</strong></td>
                    <td>{{ $servicios->moneda ?? 'Q' }}{{ $pedido->total_servicio }}</td>
                </tr>

                <!-- Lavadora o Secadora Asignada según el tipo de servicio -->
                @if ($pedido->id_precio_serv == 1)
                    <tr>
                        <td><strong>Lavadora:</strong></td>
                        <td>{{ $lavadoraAsignada->marca ?? 'No asignada' }} (LAV {{ $lavadoraAsignada->id_maquina ?? '-' }})</td>
                    </tr>
                @elseif ($pedido->id_precio_serv == 2)
                    <tr>
                        <td><strong>Secadora:</strong></td>
                        <td>{{ $secadoraAsignada->marca ?? 'No asignada' }} (SEC {{ $secadoraAsignada->id_maquina ?? '-' }})</td>
                    </tr>
                @elseif ($pedido->id_precio_serv == 3)
                    <tr>
                        <td><strong>Lavadora:</strong></td>
                        <td>{{ $lavadoraAsignada->marca ?? 'No asignada' }} (LAV {{ $lavadoraAsignada->id_maquina ?? '-' }})</td>
                    </tr>
                    <tr>
                        <td><strong>Secadora:</strong></td>
                        <td>{{ $secadoraAsignada->marca ?? 'No asignada' }} (SEC {{ $secadoraAsignada->id_maquina ?? '-' }})</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Pie de Página -->
    <div class="footer">
        <p>&copy; {{ date('Y') }} Sistema de Lavandería - Detalles del Pedido</p>
    </div>

</body>
</html>
