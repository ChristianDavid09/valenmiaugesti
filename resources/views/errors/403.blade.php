@extends('layout')

@section('title', 'Recurso no autorizado')
@section('content')
    <div class="container mt-5">
        <div class="text-center">
            <h1 class="display-4">403</h1>
            <p class="lead">Acceso denegado</p>
            <p>Lo sentimos, no tienes permiso para acceder a este recurso.</p>
            @auth
                <a href="{{ route('account') }}" class="btn btn-primary">Volver a la cuenta</a>
            @else
                <a href="{{ route('index') }}" class="btn btn-primary">Volver al inicio</a>
            @endauth
        </div>
    </div>
@endsection
