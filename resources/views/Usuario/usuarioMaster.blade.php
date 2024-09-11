@extends('layauts.base')
@section('title', 'Usuario Master')
@section('content')
    <h1>Menu de Usuario Master</h1>


    <form action="{{ route('logoutUsuario') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
    </form>
@endsection
