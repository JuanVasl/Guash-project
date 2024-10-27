@extends('layauts.base')
@section('title', 'Lavanderia')
@section('content')
<!-- Título -->
<div class="container">
    <div class="col-12">
        <h3 class="text-center"><strong>Secadoras</strong></h3>
    </div>
</div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <div class="btn-container mt-4 p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">

                <table class="table text-center">
                    <tbody>
                        <tr>
                            <td>ID</td>
                            <td>Estado</td>
                            <td>LBS</td>
                        </tr>
                    @foreach($secadora as $secadoras)
                        <tr>
                            <td>{{$secadoras->id_maquina}}</td>
                            <td>{{$secadoras->estado}}</td>
                            <td>{{$secadoras->capacidad}}</td>
                            <td>
                                <a href="{{ route('detalleSecadoras', $secadoras->id_maquina) }}" style="color: gray">
                                    <i class="fas fa-angle-double-right"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- Paginacion -->
                {{ $secadora->links() }}
            </div>
        </div>
    </div>
    <br>
    <div class="links">
        <a href="/equiposLavanderia/secadoras/create" class="btn btn-success">Agregar</a>
        <a href="/equiposLavanderia" class="btn btn-danger">Regresar</a>
    </div>
</div>
@endsection
