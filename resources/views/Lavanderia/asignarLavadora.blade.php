@extends('layauts.base')
@section('title', 'Asignar Lavadora')
@section('content')

<div class="container">
    <h3>Asignar Lavadora para el Pedido {{ $pedido->id_pedido }}</h3>
    <form action="{{ route('guardar.asignacionLavadora', $pedido->id_pedido) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_lavadora">Seleccionar Lavadora:</label>
            <select name="id_maquina" id="id_lavadora" required> <!-- Cambié el nombre a 'id_maquina' -->
                <option value="">Seleccionar lavadora...</option> <!-- Opción por defecto -->
                @foreach ($lavadora as $lavadoras)
                    <option value="{{ $lavadoras->id_maquina }}">LAV{{ $lavadoras->id_maquina }} - {{ $lavadoras->marca }} - {{ $lavadoras->capacidad }}LBS</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Asignar Lavadora</button>
    </form>
</div>
@endsection
