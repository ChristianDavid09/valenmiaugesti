@extends('layout')

@section('title', 'Modificar Anuncio')
@section('content')
<div class="container">
    <h1>Modificar Anuncio de {{ $advertisement->feline->name}}</h1>
    <img src="{{ asset('./images/colognes/felines/'. $advertisement->feline->photo) }}" alt="{{ $advertisement->feline->name }}" class="img-fluid rounded mb-3">
    <form action="{{ route('advertisement.update', $advertisement) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $advertisement->title) }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $advertisement->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Disponibilidad</label>
            <select class="form-select" name="type" id="type">
                <option value="" disabled>Selecciona una opción</option>
                <option value="Disponible" {{ old('type', $advertisement->type) == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="En acogida" {{ old('type', $advertisement->type) == 'En acogida' ? 'selected' : '' }}>En acogida</option>
                <option value="Perdido" {{ old('type', $advertisement->type) == 'Perdido' ? 'selected' : '' }}>Perdido</option>
            </select>
        </div>
        <input type="hidden" name="feline_id" value="{{ $advertisement->feline->id }}">
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </form>

@endsection
