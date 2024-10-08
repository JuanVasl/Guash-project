@extends('layauts.base')
@section('title', 'Administrador')
@section('content')

    <div class="container">
            <!-- Título -->
        <div class="container mt-2">
            <div class="col-12">
                <h3 class="text-start"><strong>¿Listos para lavar?</strong></h3>
            </div>
        </div>

        <!-- Botones de Pedir en espera y Solicitar Motorista-->
        <div class="row mb-3 mt-3">
            <div class="col-6 d-flex justify-content-center">
                <div class="btn-container p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px;">
                    <form action="{{ route('pedidos') }}" method="GET">
                        @csrf
                        <button type="submit" class="btn w-100 d-flex flex-column align-items-center" style="height: 170px;">
                            <div class="d-flex justify-content-center" style="height: 75%;">
                                <img src="https://cdn-icons-png.flaticon.com/128/4003/4003663.png" alt="Pedidos en espera" style="max-width: 100%; max-height: 100%;">
                            </div>
                            <div class="d-flex justify-content-center align-items-center" style="height: 25%;">
                                <p class="mt-5 text-center"><strong>Pedidos en espera</strong></p>
                            </div>
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-6 d-flex justify-content-center">
                <div class="btn-container p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px;">
                    <a href="https://www.google.com/travel/flights?hl=es" class="btn w-100 d-flex flex-column align-items-center" style="height: 170px;">
                        <div class="d-flex justify-content-center" style="height: 75%;">
                            <img src="https://cdn-icons-png.flaticon.com/128/3912/3912749.png" alt="Solicitar Motorista" style="max-width: 100%; max-height: 100%;">
                        </div>
                        <div class="d-flex justify-content-center align-items-center" style="height: 25%;">
                            <p class="mt-5 text-center"><strong>Solicitar Motorista</strong></p>
                        </div>
                    </a>
                </div>     
            </div>
        </div>

        <!-- Botón central Lavadoras y Secadoras -->
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <div class="btn-container p-1" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">
                    <a href="/equiposLavanderia" class="btn w-100">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="https://cdn-icons-png.flaticon.com/128/5694/5694233.png" alt="Lavadoras y Secadoras" style="width: 80px; height: 80px; margin-right: 10px;">
                            <h3 ><strong>Lavadoras y Secadoras</strong></h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <br>
     
        <!-- Botón central Cierres Contables-->
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <div class="btn-container p-1" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">
                    <a href="https://www.youtube.com/" class="btn w-100">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="https://cdn-icons-png.flaticon.com/128/11689/11689919.png" alt="Cierres Contables" style="width: 80px; height: 80px; margin-right: 10px;">
                            <h3><strong>Cierres Contables</strong></h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div>
    

@endsection
