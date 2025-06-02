@extends('layout')
@section('title', 'Página no encontrada')
@section('content')
<div class="container mt-5">
    <div class="text-center">
        <h1 class="display-4">404</h1>
        <p class="lead">Página no encontrada</p>
        <p>Lo sentimos, la página que estás buscando no existe.</p>
        @auth
            <a href="{{ route('account') }}" class="btn btn-primary">Volver a la cuenta</a>
        @else
            <a href="{{ route('index') }}" class="btn btn-primary">Volver al inicio</a>
        @endauth
    </div>
</div>

</div>
@endsection
