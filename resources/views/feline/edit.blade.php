@extends('layout')

@section('title', 'Editar Michi')

@section('content')
        <h1>Editar Michi</h1>
        <div class="container">
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $feline->name) }}" required>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Edad</label>
                <input type="number" class="form-control" id="age" name="age" value="{{ old('age', $feline->age) }}" required>
            </div>
            <div class="mb-3">
                <label for="breed" class="form-label">Raza</label>
                <input type="text" class="form-control" id="breed" name="breed" value="{{ old('breed', $feline->race) }}" required>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Foto</label>
                <input type="file" class="form-control-file" id="photo" name="photo">
            </div>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
        </div>
@endsection
