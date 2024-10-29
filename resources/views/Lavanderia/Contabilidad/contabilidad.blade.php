@extends('layauts.base')
@section('title', 'Contabilidad')
@section('content')

    <div class="container">
            <!-- Título -->
        <div class="container mt-2">
            <div class="col-12">
                <h3 class="text-start"><strong>Contabilidad</strong></h3>
            </div>
        </div>

        <!-- Primera Linea de Botones-->
        <div class="row mt-3">
            <div class="col-12 d-flex justify-content-center">
                <div class="btn-container p-1" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">
                    <form action="{{ route('inventario.insumos') }}" method="GET">
                        @csrf
                            <button type="submit" class="btn w-100 d-flex align-items-center justify-content-center">
                                <img src="https://cdn-icons-png.flaticon.com/128/1748/1748971.png" style="width: 80px; height: 80px; margin-right: 10px;">
                                <h3><strong>Inventario Insumos</strong></h3>
                            </button>
                        </form>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 d-flex justify-content-center">
                <div class="btn-container p-1" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">
                    <form action="{{ route('cierre_diario.index') }}" method="GET">
                        @csrf
                        <button type="submit" class="btn w-100 d-flex align-items-center justify-content-center">
                            <img src="https://cdn-icons-png.flaticon.com/128/2942/2942269.png" style="width: 80px; height: 80px; margin-right: 10px;">
                            <h3><strong>Cierre del día</strong></h3>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 d-flex justify-content-center">
                <div class="btn-container p-1" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">
                    <a href="{{ route('cierre_diario.historico') }}" class="btn w-100 d-flex align-items-center justify-content-center">
                        <img src="https://cdn-icons-png.flaticon.com/128/3908/3908575.png" style="width: 80px; height: 80px; margin-right: 10px;">
                        <h3><strong>Histórico de Cierre</strong></h3>
                    </a>
                </div>
            </div>
        </div>

        <a href="/menuAdmin" class="btn btn-danger mt-4">Regresar</a>

        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        title: '¡Éxito!',
                        text: '{{ session("success") }}',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
            </script>
        @endif

    </div>



@endsection
