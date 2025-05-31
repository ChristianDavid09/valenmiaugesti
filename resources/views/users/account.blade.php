@extends('layout')

@section('title', 'Cuenta')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-5 text-primary">👤 Mi Cuenta</h1>

        <div class="d-flex justify-content-center">
            <div class="card shadow-lg rounded-4 border-0" style="max-width: 600px; width: 100%;">
                <div class="card-body p-5">
                    <h2 class="h4 mb-4 text-primary border-bottom pb-2">📄 Detalles de la cuenta</h2>

                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item">
                            <strong>Rol:</strong>
                            {{ Auth::user()->rol === 'Cologne' ? 'Colonia' : 'Adoptante' }}
                        </li>
                        <li class="list-group-item">
                            <strong>{{ Auth::user()->rol === 'Cologne' ? 'Colonia' : 'Adoptante' }}:</strong>
                            {{ Auth::user()->rol === 'Cologne' ? Auth::user()->cologne->name : Auth::user()->adopter->name }}
                        </li>
                        <li class="list-group-item">
                            <strong>{{ Auth::user()->rol === 'Cologne' ? 'Nombre del Administrador' : 'Nombre' }}:</strong>
                            {{ Auth::user()->name }}
                        </li>
                        <li class="list-group-item">
                            <strong>Email:</strong> {{ Auth::user()->email }}
                        </li>
                        <li class="list-group-item">
                            <strong>Cuenta creada el:</strong> {{ Auth::user()->created_at->format('d/m/Y') }}
                        </li>
                        @if(Auth::user()->rol === 'Adopter')
                            <li class="list-group-item">
                                <strong>Certificado:</strong>
                                <a href="{{ asset('./certificates/' . Auth::user()->adopter->certificate) }}"
                                   target="_blank" class="text-decoration-none text-primary fw-semibold">
                                    📄 Ver documento
                                </a>
                            </li>
                        @endif
                    </ul>

                    <h2 class="h4 text-primary mt-4 border-top pt-4">⚙️ Acciones disponibles</h2>

                    @if (Auth::user()->rol === 'Adopter')
                        <a href="{{ route('account.edit', Auth::user()) }}" class="btn btn-outline-primary mt-3 w-100">
                            ✏️ Editar cuenta
                        </a>
                    @else
                        <button type="button" class="btn btn-outline-primary mt-3 w-100" id="button">
                            ✏️ Editar cuenta
                        </button>
                        <div id="buttons" class="mt-3" style="display: none;">
                            <a href="{{ route('account.edit', Auth::user()) }}" class="btn btn-primary mb-2 w-100">
                                🧍‍♂️ Editar Datos del Administrador
                            </a>
                            <a href="{{ route('colognes.edit', Auth::user()->cologne) }}" class="btn btn-primary w-100">
                                🏘️ Editar Datos de la Colonia
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        const button = document.getElementById('button');
        const buttons = document.getElementById('buttons');

        if (button && buttons) {
            button.addEventListener('click', () => {
                buttons.style.display = 'block';
                button.style.display = 'none';
            });
        }
    </script>

@endsection
