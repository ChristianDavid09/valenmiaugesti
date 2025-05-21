@extends('layout')

@section('title', 'Colonia')

@section('content')

<div class="container my-5">
    {{-- Ficha de la colonia --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 text-center">
                <img src="{{ asset('images/colognes/profile/' . $cologne->photo) }}"
                     alt="{{ $cologne->name }}"
                     class="img-fluid mx-auto d-block rounded-top"
                     style="max-width: 100%; height: auto;">
                <div class="card-body">
                    <h2 class="card-title text-primary">{{ $cologne->name }}</h2>
                    <p class="card-text">{{ $cologne->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- Michis publicados --}}
<div class="container my-5">
    <h2 class="mb-4 text-center">
        {{ $isOwner ? 'Mis Michis publicados en esta colonia' : 'Michis publicados en esta colonia' }}
    </h2>

    <div class="row">
        @forelse($cologne->advertisements as $adver)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0 d-flex flex-column">
                    <a href="{{ route('advertisement.show', $adver) }}">
                        <img src="{{ asset('images/colognes/adver/' . $adver->feline->photo) }}"
                             class="card-img-top rounded-top"
                             alt="{{ $adver->title }}"
                             style="object-fit: cover; height: 180px;">
                    </a>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <a href="{{ route('advertisement.show', $adver) }}" class="text-decoration-none text-dark">
                                <h5 class="card-title text-primary">{{ $adver->title }}</h5>
                            </a>
                            <p class="mb-1"><strong>Tipo:</strong> {{ $adver->type }}</p>
                            <p class="mb-1"><strong>Nombre:</strong> {{ $adver->feline->name }}</p>
                            <p class="small text-muted">{{ $adver->description }}</p>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('advertisement.show', $adver) }}" class="btn btn-outline-primary btn-sm me-1">Ver anuncio</a>
                            @if ($isOwner)
                                <a href="{{ route('advertisement.edit', $adver) }}" class="btn btn-outline-secondary btn-sm me-1">Editar</a>
                                <form action="{{ route('advertisement.destroy', $adver) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este anuncio?')">Eliminar</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center" role="alert">
                    No hay anuncios disponibles para esta colonia.
                </div>
            </div>
        @endforelse
    </div>
</div>



@endsection
