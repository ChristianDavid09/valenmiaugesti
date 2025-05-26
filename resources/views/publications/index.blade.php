@extends('layout')
@section('title', 'Publicaciones')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">📰 Últimas publicaciones</h2>
        <a href="{{ route('publications.create') }}" class="btn btn-success">
            ➕ Nueva publicación
        </a>
    </div>

    @foreach ($publications as $publication)
        <div class="card mb-4 shadow-sm rounded-4 border-0">
            <div class="card-body">

                {{-- Encabezado: Foto + Nombre --}}
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('images/adopters/profile/'.$publication->user->adopter->photo) }}"
                         class="rounded-circle me-3" width="50" height="50" style="object-fit: cover;">
                    <div>
                        <strong class="fs-5">{{ $publication->user->name }}</strong><br>
                        <small class="text-muted">
                            {{ $publication->created_at->format('d/m/Y H:i') }}
                        </small>
                    </div>
                </div>

                {{-- Título --}}
                <h5 class="card-title mt-2 mb-3 text-dark">{{ $publication->title }}</h5>

                {{-- Contenido --}}
                <p class="card-text text-muted fs-6">{{ $publication->content }}</p>

                {{-- Imagen --}}
                @if ($publication->photo)
                    <div class="text-center mb-3">
                        <img src="{{ asset('publication/photo/' . $publication->photo) }}" 
                             class="img-fluid rounded shadow-sm" style="max-height: 400px;">
                    </div>
                @endif

            </div>
        </div>
    @endforeach

</div>
@endsection
