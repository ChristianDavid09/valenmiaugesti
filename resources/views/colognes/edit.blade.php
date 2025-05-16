@extends('layout')

@section('title', 'Editar Colonia')

@section('content')
    <div class="container">
        <h1>Editar Colonia</h1>
        <form action="{{ route('colonias.update', $colonia) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nombre de la colonia</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $colonia->name }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ $colonia->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Imagen de la colonia</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            @if ($colonia->photo)
                <div class="text-center">
                    <img id="preview" src="{{ asset('./colonias/images/profile/' . $colonia->photo) }}" alt="{{ $colonia->name }}" style="display: block;" class="img-thumbnail mx-auto d-block" width="250">
                </div>
            @endif
            <button type="submit" class="btn btn-primary">Actualizar Colonia</button>
        </form>
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview');
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        });
    </script>

@endsection
