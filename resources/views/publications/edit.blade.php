@extends('layout')
@section('title', 'Editar publicación')

@section('content')
    <div class="container py-4">
        <h2 class="text-primary mb-4">✏️ Editar publicación</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
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
                <label for="content" class="form-label">Contenido</label>
                <textarea id="content" name="content" class="form-control" rows="3">{{ old('content', $publication->content) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="photo" class="form-label">Imagen (opcional)</label>
                <input type="file" id="photo" name="photo" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
    </div>

@endsection
