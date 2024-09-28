@extends('layauts.base')
@section('title', 'Motorista')
@section('content')
<!-- Título -->
<div class="container">
    <div class="col-12">
        <h3 class="text-center"><strong>Entregas pendientes</strong></h3>
    </div>
</div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <div class="btn-container mt-4 p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">

                <table class="table text-center">
                    <tbody>
                    @foreach($entrega as $entregas)
                        <tr>
                            <td>{{$entregas->id_pedido}}</td>
                            <td>{{ \Carbon\Carbon::parse($entregas->fecha)->format('d/m/Y H:i') }}</td>
                            <td>{{$entregas->nombre}}</td>
                            <td>{{$entregas->cod}}</td>
                            <td>
                                <a href="{{ route('detalles', $entregas->id_pedido) }}" style="color: gray">
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
    <br>
    <div class="links">
        <a href="/menuMoto" class="btn btn-danger">Cancelar</a>
    </div>
</div>
@endsection
