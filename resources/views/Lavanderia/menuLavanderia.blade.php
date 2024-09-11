@extends('layauts.base')
@section('title', 'Lavanderia')
@section('content')

    <h1>Menu de Lavanderia</h1>

    <form action="{{ route('logoutUsuario') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
    </form>

@endsection
