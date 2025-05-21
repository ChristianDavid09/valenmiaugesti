@extends('layout')

@section('title', 'Iniciar Sesión')

@section('content')

    <form method="POST" action="{{ route('login') }}" class="p-4 p-md-5 border rounded-3 bg-light">
        @csrf
        <div class="form-floating mb-3">
          <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
          <label for="floatingInput">Correo electrónico</label>
        </div>
        <div class="form-floating mb-3">
          <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Contraseña">
          <label for="floatingPassword">Contraseña</label>
        </div>
        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" value="remember"> Recuérdame
          </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Iniciar Sesión</button>
        <hr class="my-4">
        <small class="text-muted">Al hacer clic en Registrarse, aceptas los términos de uso.</small>
    </form>

@endsection
