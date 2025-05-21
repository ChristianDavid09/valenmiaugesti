@extends('layout')

@section('title', 'Inicio')

@section('content')
    @if (Auth::check() && Auth::user()->rol == 'Colonia')
        <div class="container">
            <h1>Bienvenido {{ Auth::user()->cologne->name }}</h1>
            <a href="{{ route('felines.index') }}" class="btn btn-primary">Dar de alta a un Felino</a>
            <h2>Colonias</h2>

        </div>
    @elseif (Auth::check() && Auth::user()->rol == 'Adoptante')
        <h1>HOLA</h1>
    @else
        <div class="container col-xxl-8 px-4 py-5">
            <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
              <div class="col-lg-6">
                <h1 class="display-5 fw-bold lh-1 mb-3">ValenMiauGesti</h1>
                <p class="lead">Diseña y personaliza rápidamente sitios móviles con capacidad responsive con Bootstrap, el
                  conjunto de herramientas de código abierto de front-end más popular del mundo, que incluye variables y
                  mixins de Sass, un sistema de cuadrícula responsive, amplios componentes preconstruidos y potentes
                  complementos de JavaScript.</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                  <button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Principal</button>
                  <button type="button" class="btn btn-outline-secondary btn-lg px-4">Por defecto</button>
                </div>
              </div>
              <div class="col-10 col-sm-8 col-lg-6">
                <img src="{{ asset('logo/icon.red.jpg') }}" class="d-block mx-lg-auto img-fluid" alt="valenmiauLogo" width="700" height="500" loading="lazy">
              </div>
            </div>
        </div>
        <div class="sign-up text-center my-5">
            <div class="row justify-content-center">
            <div class="col-md-6">
                <p class="mb-3">¿No tienes cuenta? <a href="{{ route('signUp') }}" class="text-primary font-weight-bold">Regístrate aquí</a></p>
                <p>¿Ya tienes cuenta? <a href="{{ route('index') }}" class="text-primary font-weight-bold">Inicia sesión</a></p>
            </div>
            </div>
        </div>
    @endif
@endsection
