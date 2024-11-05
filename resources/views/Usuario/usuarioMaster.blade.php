@extends('layauts.base')
@section('title', 'Usuario Master')
@section('content')
    <div class="container">
        <!-- Título -->
        <div class="container mt-2">
            <div class="col-12">
                <h3 class="text-center"><strong>Usuario Master</strong></h3>
            </div>
        </div>

        <!-- Motorista -->
        <div class="row mb-3 mt-3">
            <div class="col-6 d-flex justify-content-center">
                <div class="btn-container p-4" style="background-color: rgb(217, 217, 217); border-radius: 15px;">
                    <a href="/menuMoto" class="btn w-100 d-flex flex-column align-items-center" style="height: 170px;">
                        <div class="d-flex justify-content-center" style="height: 75%;">
                            <img src="https://cdn-icons-png.freepik.com/256/5457/5457874.png" alt="Modulo Motorista" style="max-width: 100%; max-height: 100%;">
                        </div>
                        <div class="d-flex justify-content-center align-items-center" style="height: 25%;">
                            <p class="mt-5 text-center"><strong>Motorista</strong></p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Lavanderia -->
            <div class="col-6 d-flex justify-content-center">
                <div class="btn-container p-4" style="background-color: rgb(217, 217, 217); border-radius: 15px;">
                    <a href="/menuAdmin" class="btn w-100 d-flex flex-column align-items-center" style="height: 170px;">
                        <div class="d-flex justify-content-center" style="height: 75%;">
                            <img src="https://cdn-icons-png.flaticon.com/128/5694/5694233.png" alt="Modulo Lavanderia" style="max-width: 100%; max-height: 100%;">
                        </div>
                        <div class="d-flex justify-content-center align-items-center" style="height: 25%;">
                            <p class="mt-5 text-center"><strong>Lavanderia</strong></p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
