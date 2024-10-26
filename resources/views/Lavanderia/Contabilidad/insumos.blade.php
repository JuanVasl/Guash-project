@extends('layauts.base')
@section('title', 'Inventario de Insumos')

@section('content')
<div class="container">
    <h3 class="text-center my-4"><strong>Inventario de Insumos</strong></h3>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Insumo</th>
                <th>Disp.</th>
                <th>Medida</th>
                <th>Ingreso</th>
            </tr>
        </thead>
        <tbody>
            @foreach($insumos as $insumo)
                <tr>
                    <td>{{ $insumo->nombre_insumo }}</td>
                    <td>{{ $insumo->cantidad_disponible }}</td>
                    <td>{{ $insumo->unidad_medida }}</td>
                    <td>
                        <form action="{{ route('inventario.agregarCantidad', $insumo->id_insumo) }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="number" name="cantidad" class="form-control" min="1" required>
                                <button type="submit" class="btn btn-primary">Agregar</button>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<a href="/menuAdmin/Conta" class="btn btn-danger">Regresar</a>

<script>
    // JavaScript para ocultar el mensaje después de 5 segundos
    document.addEventListener("DOMContentLoaded", function() {
        const successMessage = document.getElementById("success-message");
        if (successMessage) {
            setTimeout(function() {
                successMessage.style.display = "none";
            }, 5000); // 5000 milisegundos = 5 segundos
        }
    });
</script>
@endsection
