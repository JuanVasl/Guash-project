@extends('layauts.base')
@section('title', 'Motorista')
@section('content')
    <h1>Menu de Motorista</h1>


    <form action="{{ route('logoutUsuario') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
    </form>
@endsection
