@extends('layauts.base')
@section('title', 'Motorista')
@section('content')
    <!-- Título -->
<div class="container">
    <div class="col-12">
        <h3 class="text-center"><strong>Historial de entregas</strong></h3>
    </div>
</div>

<!-- Filtro de búsqueda -->
<div class="row">
    <div class="col-12 d-flex justify-content-center">
        <form action="{{ route('historial') }}" method="GET" class="form-inline mb-1 d-flex flex-wrap align-items-center">
            <!-- Filtro por fecha del pedido -->
            <div class="form-group mx-sm-3 mb-2">
                <label for="fecha" class="sr-only">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="{{ request('fecha') }}">
            </div>
            <!-- Botón de búsqueda -->
            <button type="submit" class="btn mb-2 ml-3">🔎</button>
            <!-- Filtro por ubicación -->
            <div class="form-group mx-sm-3 mb-2">
                <label for="ubicacion" class="sr-only">Ubicación</label>
                <select class="form-control" id="ubicacion" name="ubicacion">
                    <option value="">Seleccionar ubicación</option>
                    @foreach($ubicaciones as $ubicacion)
                        <option value="{{ $ubicacion->nombre }}" {{ request('ubicacion') == $ubicacion->nombre ? 'selected' : '' }}>
                            {{ $ubicacion->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-12 d-flex justify-content-center">
        <div class="btn-container p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">

            <table class="table text-center">
                <tbody>
                @foreach($entrega as $entregas)
                    <tr>
                        <td>{{$entregas->id_pedido}}</td>
                        <td>{{ \Carbon\Carbon::parse($entregas->fecha)->format('d/m/Y H:i') }}</td>
                        <td>{{$entregas->nombre}}</td>
                        <td>{{$entregas->cod}}</td>
                        <td>
                            <a href="{{ route('detallesHistorial', ['id_historial' => $entregas->id_historial]) }}"
                               style="color: gray">
                                <i class="fas fa-angle-double-right"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!-- Paginacion -->
            {{ $entrega->links() }}
        </div>
    </div>
</div>
<div class="links">
    <a href="/menuMoto" class="btn btn-danger mt-2">Regresar</a>
</div>
@endsection

