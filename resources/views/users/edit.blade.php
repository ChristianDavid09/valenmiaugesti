@extends('layout')

@section('title', 'Editar cuenta')

@section('content')
    <div class="container py-4">
        <h2 class="text-primary mb-4">👤 Editar cuenta</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('account.update', $user) }}" method="POST" enctype="multipart/form-data" class="shadow-sm p-4 rounded bg-white">
            @csrf
            @method('PUT')

            {{-- Datos generales --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>
            </div>

            {{-- <div class="row mb-3">
                <div class="col-md-6">
                    <label for="dni" class="form-label">DNI</label>
                    <input type="text" class="form-control" id="dni" name="dni" value="{{ old('dni', $user->dni) }}">
                </div>
            </div> --}}

            {{-- Datos específicos según el rol --}}
            @if ($user->rol === 'Cologne')
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="address" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $user->cologne->adress) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="province" class="form-label">Provincia</label>
                        <input type="text" class="form-control" id="province" name="province" value="{{ old('province', $user->cologne->province) }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->cologne->phone) }}">
                    </div>
                </div>
            @elseif ($user->rol === 'Adopter')
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="address" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $user->adopter->address) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="province" class="form-label">Provincia</label>
                        <input type="text" class="form-control" id="province" name="province" value="{{ old('province', $user->adopter->province) }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->adopter->phone) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="date_birth" class="form-label">Fecha de nacimiento</label>
                        <input type="date" class="form-control" id="date_birth" name="date_birth" value="{{ old('date_birth', $user->adopter->date_birth) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $user->adopter->description) }}</textarea>
                </div>
            @endif

            {{-- Foto de perfil --}}
            <div class="mb-3">
                <label class="form-label d-block">Foto actual</label>
                <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal">
                    <img src="{{ asset('images/' . strtolower($user->rol) . 's/profile/' . $user->photo_url) }}" alt="Foto de perfil" class="img-thumbnail mb-2" style="max-width: 150px;">
                </a>
            </div>

            <button type="button" class="btn btn-outline-secondary mb-3" id="changePhotoBtn">📷 Cambiar foto</button>
            <div class="mb-3" id="photoForm" style="display: none;">
                <label for="photo" class="form-label">Nueva foto de perfil</label>
                <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
            </div>

            {{-- Cambio de contraseña --}}
            <button type="button" class="btn btn-outline-secondary mb-3" id="changePasswordBtn">🔑 Cambiar contraseña</button>
            <div id="passwordForm" style="display: none;">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Nueva contraseña</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">💾 Actualizar cuenta</button>
            </div>
        </form>
    </div>

    {{-- Modal de imagen --}}
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <img src="{{ asset('images/' . strtolower($user->rol) . 's/profile/' . $user->photo_url) }}" class="img-fluid w-100">
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('changePasswordBtn').addEventListener('click', function () {
            document.getElementById('passwordForm').style.display = 'block';
            this.style.display = 'none';
        });

        document.getElementById('changePhotoBtn').addEventListener('click', function () {
            document.getElementById('photoForm').style.display = 'block';
            this.style.display = 'none';
        });
    </script>
@endsection
