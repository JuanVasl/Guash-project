@extends('layauts.base')
@section('title', 'Inventario de Insumos')

@section('content')
<div class="container">
    <h3 class="text-center my-4"><strong>Inventario de Insumos</strong></h3>

    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '{{ session("success") }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            });
        </script>
    @endif

    <form id="insumosForm" action="{{ route('inventario.agregarCantidad') }}" method="POST">
        @csrf
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
                            <input type="number" name="cantidades[{{ $insumo->id_insumo }}]" class="form-control" min="1">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-center my-3">
            <a href="/menuAdmin/Conta" class="btn btn-danger">Regresar</a>
            <button type="button" onclick="confirmSave()" class="btn btn-primary">Guardar</button>

        </div>
    </form>
</div>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Función para confirmar la acción de guardar
    function confirmSave() {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Se agregarán las cantidades ingresadas al inventario.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('insumosForm').submit();
            }
        });
    }
</script>
@endsection
