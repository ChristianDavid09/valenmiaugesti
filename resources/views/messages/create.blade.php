@extends('layout')

@section('title', 'Enviar Mensaje')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">Enviar mensaje a la colonia</h2>

    {{-- Tarjeta del Michi --}}
    <div class="card shadow-lg p-3 mb-5 bg-body rounded">
        <div class="row g-0 align-items-center">
            <div class="col-md-4 text-center p-3">
                <img src="{{ asset('images/colognes/felines/' . $feline->photo) }}"
                     alt="{{ $feline->name }}"
                     class="img-fluid rounded"
                     style="max-height: 250px; object-fit: cover;">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $feline->name }}</h5>
                    <p class="card-text">{{ $feline->description }}</p>

                    <strong>Colonia:</strong> {{ $cologne->name }}<br>

                    <hr>

                    <p class="card-text mb-1"><strong>Edad:</strong> {{ $feline->age }}</p>
                    <p class="card-text mb-1"><strong>Sexo:</strong> {{ $feline->sex }}</p>
                    <p class="card-text mb-1"><strong>Raza:</strong> {{ $feline->race }}</p>
                    <p class="card-text mb-1"><strong>Estado de salud:</strong> {{ $feline->health_status }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Formulario de mensaje --}}
    <form action="{{ route('messages.store') }}" method="POST" class="shadow-sm p-4 bg-light rounded">
        @csrf
        <input type="hidden" name="adver_id" value="{{ $feline->advertisement->id }}">
        <input type="hidden" name="cologne_id" value="{{ $cologne->id }}">
        @if (Auth::user()->rol == 'Adopter')
            <input type="hidden" name="adopter_id" value="{{ Auth::user()->adopter->id }}">
        @endif

        <div class="mb-3">
            <label for="type" class="form-label">Tipo de mensaje</label>
            <select class="form-select" id="type" name="type" required>
                <option selected disabled>Selecciona una opción</option>
                <option value="Consulta">Consulta</option>
                <option value="Adopción">Adopción</option>
                <option value="Otro">Otro</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="body" class="form-label">Mensaje</label>
            <textarea class="form-control" id="body" name="body" rows="5" required placeholder="Escribe aquí tu mensaje..."></textarea>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Enviar mensaje</button>
        </div>
    </form>
</div>


@endsection
