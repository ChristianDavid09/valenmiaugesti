@extends('layout')

@section('title', 'Cuenta')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-5 text-primary">👤 Mi Cuenta</h1>

        <div class="d-flex justify-content-center">
            <div class="card shadow-lg rounded-4 border-0" style="max-width: 600px; width: 100%;">
                <div class="card-body p-5">

                    <div class="text-center mb-4">
                        @if (Auth::user()->rol === 'Cologne')
                            <img src="{{ asset('images/colognes/profile/'.Auth::user()->photo_url ) }}" alt="Foto de perfil"
                                class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                        @else
                            <img src="{{ asset('images/adopters/profile/'.Auth::user()->photo_url ) }}" alt="Foto de perfil"
                                 class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                        @endif
                    </div>

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
                        <form action="{{ route('adopters.destroy', Auth::user()->adopter) }}" method="POST" class="mt-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100" onclick="return confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción es irreversible.')">
                                🗑️ Eliminar cuenta
                            </button>
                        </form>
                        <p class="mt-3 text-muted">
                            Al eliminar tu cuenta, perderás acceso a todas las funcionalidades y datos asociados.
                            Esta acción es irreversible.
                        </p>
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
                        <form action="{{ route('colognes.destroy', Auth::user()->cologne) }}" method="POST" class="mt-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100" onclick="return confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción es irreversible.')">
                                🗑️ Eliminar cuenta
                            </button>
                        </form>
                        <p class="mt-3 text-muted">
                            Al eliminar tu cuenta, perderás acceso a todas las funcionalidades y datos asociados.
                            Esta acción es irreversible.
                        </p>
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
