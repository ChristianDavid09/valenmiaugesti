@extends('layout')
@section('title', 'Crear Publicación')



@section('content')
    <div class="container">
        <h2 class="mb-4">📝 Crear nueva publicación</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('publications.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" class="form-control" name="title" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Contenido</label>
                <textarea class="form-control" name="content" rows="5" required></textarea>
            </div>


            <div class="mb-3">
                <label for="photo" class="form-label">Foto</label>
                <input type="file" class="form-control" name="photo">
            </div>

            <button type="submit" class="btn btn-success">Publicar</button>
        </form>
    </div>
@endsection



