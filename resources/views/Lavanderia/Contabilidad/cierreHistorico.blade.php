@extends('layauts.base')
@section('title', 'Cierres Diarios')
@section('content')

<div class="container">
    <!-- Título -->
    <div class="container mt-2">
        <div class="col-12">
            <h3 class="text-center"><strong>Cierres Diarios</strong></h3>
        </div>
    </div>

    <!-- Formulario de filtro por mes -->
    <form action="{{ route('cierre_diario.historico') }}" method="GET" class="d-flex justify-content-center mb-3">
        <input type="month" name="month" id="month" class="form-control" style="width: 200px;" value="{{ request('month', date('Y-m')) }}"  required>
        <button type="submit" class="btn btn-outline-primary"><i class="fas fa-search"></i></button>
    </form>

    <!-- Tabla de cierres -->
    <div class="btn-container p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Pedidos</th>
                        <th>Q</th>
                        <th>PDF</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cierres as $cierre)
                        <tr>
                            <td>{{ $cierre->fecha }}</td>
                            <td>{{ $cierre->total_pedidos }}</td>
                            <td>{{ $cierre->total_ingresos }}</td>
                            <td><a href="{{ route('cierre_diario.detalle', $cierre->id_cierre) }}"><i class="far fa-file-pdf"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-center">
            {{ $cierres->links() }}
        </div>

        <a href="/menuAdmin/Conta" class="btn btn-danger">Regresar</a>
        <a href="" class="btn btn-primary" target="_blank"><i class="far fa-file-pdf"></i> Exportar a PDF</a>
    </div>
</div>

@endsection
