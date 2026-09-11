@extends('layout')

@section('title', 'Iniciar Sesión')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-body p-5">

```
                <h2 class="text-center mb-4 text-primary">
                    🔐 Iniciar Sesión
                </h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Mensaje de error --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <div class="form-floating mb-3">
                        <input
                            name="email"
                            type="email"
                            class="form-control"
                            id="floatingInput"
                            placeholder="name@example.com"
                            required
                        >
                        <label for="floatingInput">
                            Correo electrónico
                        </label>
                    </div>

                    <div class="form-floating mb-2">
                        <input
                            name="password"
                            type="password"
                            class="form-control"
                            id="floatingPassword"
                            placeholder="Contraseña"
                            required
                        >
                        <label for="floatingPassword">
                            Contraseña
                        </label>
                    </div>

                    {{-- Recuperar contraseña --}}
                    <div class="text-end mb-3">
                        <a href="{{ route('password.request') }}"
                           class="text-decoration-none text-primary fw-semibold">
                            ¿Has olvidado tu contraseña?
                        </a>
                    </div>

                    <div class="form-check mb-3">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="remember"
                            id="remember"
                        >

                        <label class="form-check-label" for="remember">
                            Recuérdame
                        </label>
                    </div>

                    <button
                        class="w-100 btn btn-lg btn-primary"
                        type="submit"
                    >
                        🔓 Iniciar Sesión
                    </button>

                    <hr class="my-4">

                    <small class="text-muted d-block text-center">
                        ¿No tienes cuenta?
                        <a
                            href="{{ route('signUp') }}"
                            class="text-decoration-none text-primary fw-semibold"
                        >
                            Regístrate aquí
                        </a>
                    </small>

                    <small class="text-muted d-block text-center mt-2">
                        Al hacer clic en Iniciar Sesión, aceptas nuestros
                        <a
                            href="{{ route('termsOfService') }}"
                            class="text-decoration-none"
                        >
                            términos de uso
                        </a>.
                    </small>

                </form>
            </div>
        </div>
    </div>
</div>
```

</div>
@endsection
