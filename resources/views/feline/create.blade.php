@extends('layout')

@section('title', 'Alta Michi')

@section('content')
    <div class="container">
    <h1>Dar de alta a un Michi</h1>
    <form action=" {{ route('felines.store') }}" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="image" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="text-center">
            <img id="preview" src="#" alt="Vista previa" style="display: none;" class="img-thumbnail mx-auto d-block" width="250">
        </div>
        @csrf
        <h4>Datos del Felino</h4>
        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Michi &#128568;</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="age" class="form-label">Edad</label>
            <input type="text" class="form-control" id="age" name="age" required>
        </div>
        <div class="mb-3">
            <label for="race" class="form-label">Raza</label>
            <input type="text" class="form-control" id="race" name="race">
        </div>
        <div class="mb-3">
            <label for="sex" class="form-label">Sexo</label>
            <select class="form-select" name="sex" id="sex">
                <option value="" selected disabled>Selecciona una opción</option>
                <option value="Macho">Macho</option>
                <option value="Hembra">Hembra</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="health_status">Estado de Salud</label>
            <select class="form-select" name="health_status" id="health_status">
                <option value="" selected disabled>Selecciona una opción</option>
                <option value="Sano">Sin tratamiento</option>
                <option value="En tratamiento">En tratamiento</option>
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
