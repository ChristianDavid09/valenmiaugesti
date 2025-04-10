@extends('layout')



@section('title', 'Inicio')




@section('content')

    <section class="singUp">
        <div class="row">
            No tienes cuenta? <a href="{{ route('signUp') }}">Registrate</a><br>
            Tienes cuenta? <a href="">Inicia sesión</a>
        </div>
    </section>

@endsection
