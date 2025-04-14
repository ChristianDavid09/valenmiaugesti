@extends('layout')


@section('title', 'Registro')

@section('content')

<div class="container mt-4">
    <h1>Registro</h1>
    <p>Por favor, selecciona el tipo de usuario que deseas registrar.</p>
    <p>Si ya tienes cuenta, puedes iniciar sesión <a href="">aquí</a>.</p>
</div>
<div class="container mt-4">
    <div class="mb-3">
        <label for="user_type" class="form-label">Tipo de usuario</label>
        <select class="form-select" name="user_type" id="user_type">
            <option value="" selected disabled>Selecciona una opción</option>
            <option value="admin_colonia">Administrador colonia</option>
            <option value="adoptante">Adoptante</option>
        </select>
    </div>

    <div id="form-adoptante" class="container mt-4" style="display: none;">
        <form class="user-form" action="{{ route('signUpAdoptante') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-2">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="" required>
                </div>
                <div class="col-md-6">
                    <label for="surname" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" name="surname" id="surname" placeholder="" required>
                </div>
            </div>
            <div class="row g-2">
                <div class="col-md-6">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="mail" class="form-control" name="email" id="email" placeholder="" required>
                </div>
                <div class="col-md-6">
                    <label for="dni" class="form-label">DNI/NIE</label>
                    <input type="text" class="form-control" name="dni" id="dni" placeholder="" required>
                </div>
            </div>
            <div class="row g-2">
                <label for="agre" class="form-label">Año de nacimiento</label>
                <input type="date" class="form-control" name="age" id="age" placeholder="" required>
            </div>
            <div class="row g-2">
                <div class="col-md-6">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="" required>
                </div>
                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label">Repite la contraseña</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="" required>
                </div>
            </div>
            <div class="row g-2">
                <label for="certificate" class="form-label">Certificado de delitos penales</label>
                <input type="file" class="form-control" name="certificate" id="certificate">
                <div class="text-muted">Este certificado es obligatorio para garantizar la seguridad de los felinos.</div>
            </div>
            <div class="text-muted mt-3">------------------------ Datos complementarios no obligatorios ------------------------</div>
            <div class="row g-2">
                <div class="col-md-6">
                    <label for="phone" class="form-label">Móvil</label>
                    <input type="phone" class="form-control" name="phone" id="phone" placeholder="" required>
                </div>
            </div>
            <div class="row g-2">
                <div class="col-md-6">
                    <label for="address" class="form-label">Dirección</label>
                    <input type="text" class="form-control" name="address" id="address" placeholder="" required>
                </div>
                <div class="col-md-6">
                    <label for="city" class="form-label">Provincia</label>
                    <input type="text" class="form-control" name="city" id="city" placeholder="" required>
                </div>
            </div>
            <div class="row g-2">
                <div class="col-md-6 mt-3">
                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Breve presentación personal (opcional)"></textarea>
                </div>
            </div>
            <div class="mb-2">
                <label for="photo">Foto de perfil</label>
                <input type="file" class="form-control" name="photo" id="photo">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Registrarse</button>
        </form>
    </div>

    <div id="form-admin" class="container mt-4" style="display: none;">


        <h4>Datos Administrador</h4>
        <form action="{{ route('signUpColonia') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-2">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nombre" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>
            </div>
            <div class="row g-2">
                <label for="phone" class="form-label">Teléfono de contacto</label>
                <input type="text" class="form-control" name="phone" id="phone" required>
            </div>
            <div class="row g-2">
                <h4>Datos de la Colonia</h4>
                <div class="col-md-6">
                    <label for="colonia_name" class="form-label">Nombre de la colonia</label>
                    <input type="text" class="form-control" name="colonia_name" id="colonia_name" required>
                </div>
                <div class="col-md-6">
                    <label for="id_com_ref" class="form-label">Numero de referencia de la Colonia</label>
                    <input type="text" class="form-control" name="id_ref_com" id="id_ref_com" required>
                    <div class="text-muted">Este numero identificador debe ser expedido por el Ayuntamiento de la provincia de la colonia</div>
                </div>
            </div>
            <div class="row g-2">
                <div class="col-md-6">
                    <label for="colonia_location" class="form-label">Dirección</label>
                    <input type="text" class="form-control" name="colonia_location" id="colonia_location" required>
                </div>
                <div class="col-md-6">
                    <label for="city" class="form-label">Provincia</label>
                    <input type="text" class="form-control" name="city" id="city" required>
                </div>
            </div>
            <div class="row g-2">
                <div class="col-md-6">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="" required>
                </div>
                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label">Repite la contraseña</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="" required>
                </div>
            </div>
            <div class="row g-2">
                <div class="col-md-6 mt-3">
                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Descripción de la colonia"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Registrarse</button>
        </form>
    </div>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif



<script>
    document.getElementById('user_type').addEventListener('change', function () {
        document.getElementById('form-adoptante').style.display = (this.value === 'adoptante') ? 'block' : 'none';
        document.getElementById('form-admin').style.display = (this.value === 'admin_colonia') ? 'block' : 'none';
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
