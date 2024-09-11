@extends('layauts.base')
@section('title', 'Cliente')
@section('content')
    <h1>Menu de cliente</h1>


    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
    </form>
@endsection
