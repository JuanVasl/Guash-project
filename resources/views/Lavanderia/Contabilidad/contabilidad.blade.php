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
        <div class="row mb-3 mt-3">
            <div class="col-6 d-flex justify-content-center">
                <div class="btn-container p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px;">
                    <form action="{{ route('inventario.insumos') }}" method="GET">
                        @csrf
                        <button type="submit" class="btn w-100 d-flex flex-column align-items-center" style="height: 170px;">
                            <div class="d-flex justify-content-center" style="height: 75%;">
                                <img src="https://cdn-icons-png.flaticon.com/128/1748/1748971.png"  style="max-width: 100%; max-height: 100%;">

                            </div>
                            <div class="d-flex justify-content-center align-items-center" style="height: 25%;">
                                <p class="mt-5 text-center"><strong>Inventario Insumos</strong></p>
                            </div>
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-6 d-flex justify-content-center">
                <div class="btn-container p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px;">
                    <a href=" " class="btn w-100 d-flex flex-column align-items-center" style="height: 170px;">
                        <div class="d-flex justify-content-center" style="height: 75%;">
                            <img src="https://cdn-icons-png.flaticon.com/128/1652/1652752.png" style="max-width: 100%; max-height: 100%;">
                        </div>
                        <div class="d-flex justify-content-center align-items-center" style="height: 25%;">
                            <p class="mt-5 text-center"><strong>Consumos</strong></p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Segunda Linea de Botones-->
        <div class="row mb-3 mt-3">
            <div class="col-6 d-flex justify-content-center">
                <div class="btn-container p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px;">
                    <form action=" " method="GET">
                        @csrf
                        <button type="submit" class="btn w-100 d-flex flex-column align-items-center" style="height: 170px;">
                            <div class="d-flex justify-content-center" style="height: 75%;">
                                <img src="https://cdn-icons-png.flaticon.com/128/2942/2942269.png" style="max-width: 100%; max-height: 100%;">

                            </div>
                            <div class="d-flex justify-content-center align-items-center" style="height: 25%;">
                                <p class="mt-5 text-center"><strong>Cierre del día</strong></p>
                            </div>
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-6 d-flex justify-content-center">
                <div class="btn-container p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px;">
                    <a href=" " class="btn w-100 d-flex flex-column align-items-center" style="height: 170px;">
                        <div class="d-flex justify-content-center" style="height: 75%;">
                            <img src="https://cdn-icons-png.flaticon.com/128/3908/3908575.png" style="max-width: 100%; max-height: 100%;">
                        </div>
                        <div class="d-flex justify-content-center align-items-center" style="height: 25%;">
                            <p class="mt-5 text-center"><strong>Historico de Cierre</strong></p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <a href="/menuAdmin" class="btn btn-danger">Regresar</a>

@endsection
