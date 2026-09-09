@extends('layout')

@section('title', 'Editar Michi')

@section('content')
<div class="container d-flex justify-content-center py-5">
    <div class="card shadow-lg border-0 rounded-4 p-4 w-100" style="max-width: 600px;">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h2 class="text-center text-primary mb-4">🐱 Editar Michi</h2>

        <form action="{{ route('felines.update', $feline) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Nombre</label>
                <input type="text" class="form-control" id="name" name="name"
                       value="{{ old('name', $feline->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="age" class="form-label fw-semibold">Edad</label>
                <input type="number" class="form-control" id="age" name="age"
                       value="{{ old('age', $feline->age) }}">
            </div>

            <div class="mb-3">
                <label for="race" class="form-label fw-semibold">Raza</label>
                <input type="text" class="form-control" id="race" name="race"
                       value="{{ old('race', $feline->race) }}" required>
            </div>

            <div class="mb-3">
                <label for="sex" class="form-label fw-semibold">Sexo</label>
                <select class="form-select" name="sex" id="sex" required>
                    <option disabled selected>Selecciona una opción</option>
                    <option value="Macho" {{ old('sex', $feline->sex) === 'Macho' ? 'selected' : '' }}>Macho</option>
                    <option value="Hembra" {{ old('sex', $feline->sex) === 'Hembra' ? 'selected' : '' }}>Hembra</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="health_status" class="form-label fw-semibold">Estado de Salud</label>
                <select class="form-select" name="health_status" id="health_status" required>
                    <option disabled selected>Selecciona una opción</option>
                    <option value="Sano" {{ old('health_status', $feline->health_status) === 'Sano' ? 'selected' : '' }}>Sin tratamiento</option>
                    <option value="En tratamiento" {{ old('health_status', $feline->health_status) === 'En tratamiento' ? 'selected' : '' }}>En tratamiento</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="sterilized" class="form-label fw-semibold">Esterilizado</label>
                <select class="form-select" name="sterilized" id="sterilized" required>
                    <option disabled selected>Selecciona una opción</option>
                    <option value="Si" {{ old('sterilized', $feline->sterilized) === 'Si' ? 'selected' : '' }}>Sí</option>
                    <option value="No" {{ old('sterilized', $feline->sterilized) === 'No' ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label fw-semibold">Imagen (opcional)</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/png, image/jpeg, image/jpg">
            </div>

            @if ($feline->photo)
                <div class="mb-3 text-center">
                    <img src="{{ Storage::disk('s3')->url('colognes/felines/'. $feline->photo) }}" alt="Imagen de la publicación" class="img-thumbnail rounded shadow-sm" style="max-width: 300px; height: auto;">
                    <p class="text-muted mt-2 mb-0">Imagen actual</p>
                </div>
            @endif

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary btn-lg rounded-pill">💾 Guardar cambios</button>
            </div>
        </form>
    </div>
</div>
@endsection
