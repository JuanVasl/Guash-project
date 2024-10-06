@extends('layauts.base')
@section('title', 'Administrador')
@section('content')

    <div class="container">
            <!-- Título -->
        <div class="container mt-5">
            <div class="col-12">
                <h3 class="text-center"><strong>Seleccione una opcion</strong></h3>
            </div>
        </div>

        <!-- Boton de Lavadora-->
        <div class="row mb-3 mt-5">
            <div class="col-6 d-flex justify-content-center">
                <div class="btn-container p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px;">
                    <form action="{{ route('lavadoras') }}" method="GET">
                        @csrf
                        <button type="submit" class="btn w-100 d-flex flex-column align-items-center" style="height: 170px;">
                            <div class="d-flex justify-content-center" style="height: 75%;">
                                <img src="https://cdn-icons-png.flaticon.com/128/2796/2796427.png" alt="Lavadoras" style="max-width: 100%; max-height: 100%;">
                            </div>
                            <div class="d-flex justify-content-center align-items-center" style="height: 25%;">
                                <p class="mt-5 text-center"><strong>Lavadoras</strong></p>
                            </div>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Boton de Secadora-->
            <div class="col-6 d-flex justify-content-center">
                <div class="btn-container p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px;">
                    <a href="https://www.google.com/travel/flights?hl=es" class="btn w-100 d-flex flex-column align-items-center" style="height: 170px;">
                        <div class="d-flex justify-content-center" style="height: 75%;">
                            <img src="https://cdn-icons-png.flaticon.com/128/17393/17393708.png" alt="Secadoras" style="max-width: 100%; max-height: 100%;">
                        </div>
                        <div class="d-flex justify-content-center align-items-center" style="height: 25%;">
                            <p class="mt-5 text-center"><strong>Secadoras</strong></p>
                        </div>
                    </a>
                </div>     
            </div>
        </div>

    </div>
    

@endsection
