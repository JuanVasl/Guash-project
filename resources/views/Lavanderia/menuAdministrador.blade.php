@extends('layauts.base')
@section('title', 'Administrador')
@section('content')

    <h1>Menu de Lavanderia Administrador</h1>

    <form action="{{ route('logoutUsuario') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
    </form>

@endsection
