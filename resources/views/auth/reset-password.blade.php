@extends('layout')

@section('title', 'Restablecer contraseña')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">

                <div class="card shadow-lg rounded-4 border-0">
                    <div class="card-body p-5">

                        <div class="text-center mb-4">
                            <div class="fs-1 mb-2">🔐</div>

                            <h1 class="h3 text-primary mb-2">
                                Restablecer contraseña
                            </h1>

                            <p class="text-muted mb-0">
                                Introduce tu nueva contraseña para recuperar el acceso a tu cuenta.
                            </p>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    Correo electrónico
                                </label>

                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    value="{{ old('email', $email) }}"
                                    placeholder="ejemplo@correo.com"
                                    required
                                    autofocus
                                >
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    Nueva contraseña
                                </label>

                                <input
                                    type="password"
                                    class="form-control"
                                    id="password"
                                    name="password"
                                    placeholder="Nueva contraseña"
                                    required
                                >
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">
                                    Repetir contraseña
                                </label>

                                <input
                                    type="password"
                                    class="form-control"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    placeholder="Repite la nueva contraseña"
                                    required
                                >
                            </div>

                            <button
                                type="submit"
                                class="btn btn-primary w-100"
                            >
                                🔑 Cambiar contraseña
                            </button>
                        </form>

                        <div class="text-center mt-4">
                            <a
                                href="{{ route('loginForm') }}"
                                class="text-decoration-none"
                            >
                                ← Volver al inicio de sesión
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection