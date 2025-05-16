@extends('layout')

@section('title', 'Anuncios')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($anuncios as $anuncio)
            <div class="col-md-4">
                <div class="card mb-4">
                    {{-- Imagen del felino --}}
                    <img src="{{ asset('./colonias/images/anuncios/'. $anuncio->felino->photo) }}" class="card-img-top img-fluid rounded" alt="{{ $anuncio->titulo }}">

                    <div class="card-body">
                        {{-- Título del anuncio --}}
                        <h5 class="card-title">{{ $anuncio->title }}</h5>

                        {{-- Descripción del anuncio --}}
                        <p class="card-text">{{ $anuncio->description }}</p>

                        {{-- Disponibilidad del anuncio --}}
                        <div class="d-flex align-items-center">
                            <span class="status-dot {{ $anuncio->type == 'Disponible' ? 'bg-success' : ($anuncio->type == 'En acogida' ? 'bg-warning' : 'bg-secondary') }}"></span>
                            <strong class="ms-2">Disponibilidad: </strong> {{ $anuncio->type }}
                        </div>
                        <a href="{{ route('adver.edit', $anuncio) }}" class="btn btn-secondary mt-2">Editar</a>
                        <form action="{{ route('adver.destroy', $anuncio) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mt-2">Eliminar</button>
                        </form>

                        {{-- Formulario para eliminar el anuncio --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<style>
    .status-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
    }
    .bg-success {
        background-color: #28a745;
    }
    .bg-warning {
        background-color: #ffc107;
    }
    .bg-secondary {
        background-color: #6c757d;
    }
</style>
@endsection
