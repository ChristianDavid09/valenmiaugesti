@extends('layout');

@section('title', 'Editar colonia')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4">Editar Colonia</h1>

        <form action="{{ route('colognes.update', $cologne) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nombre de la colonia</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $cologne->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $cologne->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="photo_url" class="form-label">Foto de la colonia</label>
                <input type="file" class="form-control" id="photo_url" name="photo_url">
                @if ($cologne->photo_url)
                    <img src="{{ asset('images/colognes/profile/' . $cologne->photo_url) }}" alt="Foto de la colonia" class="img-fluid mt-2" style="max-width: 200px;">
                @endif
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Ubicación</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $cologne->location) }}" required>
            </div>
            <div class="mb-3">
                <label for="latitude" class="form-label">Latitud</label>
                <input type="text" class="form-control" id="latitude" name="latitude" value="{{ old('latitude', $cologne->latitude) }}" required>
            </div>

@endsection
