@extends('layout')

@section('title', 'Crear Anuncio')

@section('content')
<div class="container">
    <h1>Crear Anuncio</h1>
    <form action=" {{ route('adven.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="image" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="text-center">
            <img id="preview" src="#" alt="Vista previa" style="display: none;" class="img-thumbnail mx-auto d-block" width="250">
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Disponibilidad</label>
            <select class="form-select" name="type" id="type">
                <option value="" selected disabled>Selecciona una opción</option>
                <option value="Disponible">Disponible</option>
                <option value="En acogida">En acogida</option>
                <option value="Perdido">Perdido</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="feline" class="form-label">De que felino quieres publicar el anuncio?</label>
            <select class="form-select" name="feline" id="feline">
                <option value="" selected disabled>Selecciona una opción</option>
                @foreach ($felines as $feline)
                    <option value="{{ $feline->id }}">{{ $feline->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Crear Anuncio</button>
    </form>
    <script>
        /*Obtenemos el file a traves del input, y le asignamos un evento, cuando este cambie,
        * dentro del evento se accede al archivo mediante event.target.files[0], que contiene una lista de 
        * los archivos seleccionados, en este caso se asume que solo tiene uno.
        * Creamos una instancia FileReader, una API de JS que permite leer el contenido de archivos de manera asincrona,
        * en este caso se utiliza para leer la imagen seleccionada.
        * Cuando el archivo ha sido leido correctamente se ejecuta el evento onload.
        */
        document.getElementById('image').addEventListener('change', function(event) {
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
