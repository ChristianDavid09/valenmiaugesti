@extends('layout')



@section('title', 'Inicio')




@section('content')
    @if (Auth::check() && Auth::user()->rol == 'Colonia')
        <div class="container">
            <h1>Bienvenido {{ Auth::user()->name }}</h1>
            <p>Esta es la página de inicio de sesión.</p>
            <a href="{{ route('adven.create') }}" class="btn btn-primary">Crear Anuncio</a>
            <a href="{{ route('felinos.index') }}" class="btn btn-secondary">Dar de alta a un Felino</a>
        </div>
        
    @elseif (Auth::check() && Auth::user()->rol == 'Adoptante')
        <h1>HOLA</h1>
    @else
        <section class="sign-up text-center my-5">
            <div class="row justify-content-center">
            <div class="col-md-6">
                <p class="mb-3">¿No tienes cuenta? <a href="{{ route('signUp') }}" class="text-primary font-weight-bold">Regístrate aquí</a></p>
                <p>¿Ya tienes cuenta? <a href="{{ route('index') }}" class="text-primary font-weight-bold">Inicia sesión</a></p>
            </div>
            </div>
        </section>
    @endif
@endsection
