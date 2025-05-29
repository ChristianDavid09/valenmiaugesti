{{-- filepath: c:\laragon\www\valenMiauGesti\resources\views\advertisement\create.blade.php --}}
@extends('layout')

@section('title', 'Crear Anuncio')

@section('content')
<div class="container">
    <h1>Crear Anuncio para {{ $feline->name }}</h1>
    {{-- Mostrar la imagen del felino --}}
    <div class="mb-3">
        <img src="{{ asset('./images/colognes/felines/'. $feline->photo) }}" alt="{{ $feline->name }}" class="img-fluid rounded">
    </div>
    <form action="{{ route('advertisement.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
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
        {{-- Campo oculto para enviar el ID del felino --}}
        <input type="hidden" name="feline_id" value="{{ $feline->id }}">
        <button type="submit" class="btn btn-primary">Crear Anuncio</button>
    </form>
</div>
@endsection
