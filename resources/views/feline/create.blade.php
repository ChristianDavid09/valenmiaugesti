<div class="container">
    <h1>Dar de alta a un Michi</h1>
    <form action=" {{ route('felinos.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="image" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="text-center">
            <img id="preview" src="#" alt="Vista previa" style="display: none;" class="img-thumbnail mx-auto d-block" width="250">
        </div>
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