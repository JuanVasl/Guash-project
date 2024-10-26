@extends('layauts.base')
@section('title', 'Cierres Diarios')
@section('content')

<div class="container">
    <!-- Título -->
    <div class="container mt-2">
        <div class="col-12">
            <h3 class="text-start"><strong>Cierres Diarios</strong></h3>
        </div>
    </div>

    <!-- Tabla de cierres -->
    <div class="table-responsive mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Total Pedidos</th>
                    <th>Total Ingresos</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cierres as $cierre)
                    <tr>
                        <td><a href="{{ route('cierre_diario.detalle', $cierre->id_cierre) }}">{{ $cierre->fecha }}</a></td>
                        <td>{{ $cierre->total_pedidos }}</td>
                        <td>{{ $cierre->total_ingresos }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="/menuAdmin/Conta" class="btn btn-danger">Regresar</a>
</div>

@endsection
