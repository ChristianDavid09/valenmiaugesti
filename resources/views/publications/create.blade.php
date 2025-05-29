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
                <label for="content" class="form-label">Contenido</label>
                <textarea class="form-control" name="content" rows="5" required value={{ old('content') }}></textarea>
            </div>


            <div class="mb-3">
                <label for="photo" class="form-label">Foto</label>
                <input type="file" class="form-control" name="photo" id="photo" value="{{ old('photo') }}">
            </div>
            <div class="text-center">
                <img id="preview" src="#" alt="Vista previa" style="display: none;" class="img-thumbnail mx-auto d-block" width="250">
            </div>

            <button type="submit" class="btn btn-success">Publicar</button>
        </form>
    </div>
    <script>
        document.getElementById('photo').addEventListener('change', function(event) {
          const file = event.target.files[0];
          const preview = document.getElementById('preview');

          if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
              preview.src = e.target.result;
              preview.style.display = 'block';
            };

            reader.readAsDataURL(file);
          }
        });
    </script>
@endsection



