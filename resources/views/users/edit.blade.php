@extends('layout')

@section('title', 'Editar cuenta')

@section('content')
    <div class="container">
        <h1>Editar cuenta</h1>
        <form action="{{ route('account.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>
            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" class="form-control" id="dni" name="dni" value="{{ $user->dni }}">
            </div>
            

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changePasswordModal" id="changePassword">Cambiar contraseña</button>
            <div id="changePasswordForm" style="display: none;">
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>
            </div>
            {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deleteAccountModal" id="changeImage">Cambiar foto</button>
            <div class="mb-3" type="hidden" id="changeImageForm" style="display: none;">
                <label for="photo" class="form-label">Foto de perfil</label>
                <input type="file" class="form-control-file" id="photo" name="photo">
            </div> --}}

            <button type="submit" class="btn btn-primary">Actualizar cuenta</button>
        </form>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
    <script>
        /* var button = document.getElementById('changeImage');
        var changeImageForm = document.getElementById('changeImageForm');

        button.addEventListener('click', function () {
            changeImageForm.style.display = 'block';
            button.style.display = 'none';
        }); */

        var button = document.getElementById('changePassword');
        var changePasswordForm = document.getElementById('changePasswordForm');

        // Cambiar la visibilidad del formulario de contraseña

        button.addEventListener('click', function () {
            changePasswordForm.style.display = 'block';
            button.style.display = 'none';
        });

    </script>

@endsection
