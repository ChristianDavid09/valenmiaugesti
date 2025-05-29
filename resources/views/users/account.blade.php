@extends('layout')

@section('title', 'Cuenta')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">👤 Mi Cuenta</h1>

        <div class="card shadow-lg rounded-4 border-0 mb-4">
            <div class="card-body p-4">
                <h2 class="h4 mb-3 text-primary">Detalles de la cuenta</h2>
                <ul class="list-group list-group-flush mb-3">
                    <li class="list-group-item">
                        <strong>Rol:</strong> {{ Auth::user()->rol }}
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
                               target="_blank" class="text-decoration-none text-primary">
                                Ver documento 📄
                            </a>
                        </li>
                    @endif
                </ul>

                <h2 class="h4 mt-4 text-primary">Acciones disponibles</h2>

                @if (Auth::user()->rol === 'Adopter')
                    <a href="{{ route('account.edit', Auth::user()) }}" class="btn btn-outline-primary mt-2">
                        ✏️ Editar cuenta
                    </a>
                @else
                    <button type="button" class="btn btn-outline-primary mt-2" id="button">
                        ✏️ Editar cuenta
                    </button>
                    <div id="buttons" class="mt-3" style="display: none;">
                        <a href="{{ route('account.edit', Auth::user()) }}" class="btn btn-primary mb-2 w-100">
                            ✏️ Editar Datos del Administrador
                        </a>
                        <a href="{{ route('colognes.edit', Auth::user()->cologne) }}" class="btn btn-primary w-100">
                            🏘️ Editar Datos de la Colonia
                        </a>
                    </div>
                @endif
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
