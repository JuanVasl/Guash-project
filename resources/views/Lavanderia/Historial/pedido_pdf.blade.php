@section('title', 'Detalles del Pedido PDF')

<!-- Contenido de Detalles del Pedido para Exportación PDF -->
<div class="container">
    <div class="text-center">
        <h3><strong>Detalles de Pedido</strong></h3>
        <h5><strong>Pedido ID: {{ $pedido->id_pedido }} - Fecha: {{ \Carbon\Carbon::parse($pedido->fecha)->format('d/m/y') }}</strong></h5>
    </div>

    <div class="p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px; max-width: 600px; margin: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="border: 1px solid #000; padding: 8px; text-align: left;">Descripción</th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: left;">Detalles</th>
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
</div>

<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 80vh;
        margin: 0;
        background-color: #f8f9fa;
        font-family: Arial, sans-serif;
    }
    .container {
        text-align: center;
        width: 100%;
        max-width: 600px; /* Limitar el ancho de la tabla */
        margin: 0 auto; /* Centrar el contenedor */
    }
    table {
        margin: 0 auto; /* Centrar la tabla */
    }
    th, td {
        border: 1px solid #000; /* Bordes para la tabla */
        padding: 8px; /* Espaciado interno */
    }
    th {
        background-color: #f2f2f2; /* Color de fondo para encabezados */
    }
</style>
