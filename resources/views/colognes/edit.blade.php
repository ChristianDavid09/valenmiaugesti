@extends('layout')

@section('title', 'Editar Colonia')

@section('content')
    <div class="container">
        <h1>Editar Colonia</h1>
        <form action="{{ route('updateColony', $cologne) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row-3">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre de la colonia</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $cologne->name }}" required>
                </div>
                {{-- <div class="mb-3">
                    <label for="id_ref_com" class="form-label">ID de referencia</label>
                    <input type="text" class="form-control" id="id_ref_com" name="id_ref_com" value="{{ $cologne->id_ref_com }}" required>
                </div> --}}
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ $cologne->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Imagen de la colonia</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            @if ($cologne->photo) {
                Storage::disk('s3')->delete(
                    'colognes/profile/' . $cologne->photo
                );
            }
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
