@extends('layout')

@section('title', 'Editar publicación')

@section('content')
<div class="container d-flex justify-content-center py-5">
    <div class="card shadow-lg border-0 rounded-4 p-4" style="max-width: 600px; width: 100%;">
        <h2 class="text-center text-primary mb-4">✏️ Editar publicación</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('publications.update', $publication) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="content" class="form-label fw-semibold">Contenido</label>
                <textarea id="content" name="content" class="form-control" rows="4" placeholder="Escribe tu publicación...">{{ old('content', $publication->content) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="photo" class="form-label fw-semibold">Imagen (opcional)</label>
                <input type="file" id="photo" name="photo" class="form-control">
            </div>

            @if ($publication->photo)
                <div class="mb-3 text-center">
                    <img src="{{ asset('pubs/photo/' . $publication->photo) }}" alt="Imagen de la publicación" class="img-thumbnail rounded shadow-sm" style="max-width: 300px; height: auto;">
                    <p class="text-muted mt-2 mb-0">Imagen actual: {{ $publication->photo }}</p>
                </div>
            @endif

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary btn-lg rounded-pill">💾 Guardar cambios</button>
            </div>
        </form>
    </div>
</div>
@endsection
