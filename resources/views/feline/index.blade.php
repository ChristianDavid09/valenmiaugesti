@extends('layout')

@section('title', 'Michis')

@section('content')

<div class="container my-5">
    <h1 class="mb-4 text-center">Michis de mi Colonia</h1>

    <div class="row mb-4">
        <div class="col text-center">
            <a href="{{ route('felines.create') }}" class="btn btn-primary">Dar de alta a un Michi</a>
        </div>
    </div>

    <div class="row">
        {{-- Columna de michis publicados --}}
        <div class="col-md-6">
            <h3 class="mb-3">Michis publicados</h3>

            @if ($felines->where('in_active', 1)->isNotEmpty())
                <div class="row">
                    @foreach ($felines->where('in_active', 1) as $feline)
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm border-0 h-100">
                                <img src="{{ asset('images/colognes/adver/' . $feline->photo) }}"
                                     class="card-img-top rounded-top"
                                     alt="{{ $feline->name }}"
                                     style="height: 200px; object-fit: cover;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="card-title text-primary">{{ $feline->name }}</h5>
                                        <p class="mb-1"><strong>Edad:</strong> {{ $feline->age }} años</p>
                                        <p class="mb-1"><strong>Raza:</strong> {{ $feline->race }}</p>
                                        <p class="mb-1"><strong>Sexo:</strong> {{ $feline->sex }}</p>
                                        <p class="mb-1"><strong>Estado de salud:</strong> {{ $feline->health_status }}</p>
                                    </div>

                                    <div class="mt-3">
                                        <a href="{{ route('felines.edit', $feline) }}" class="btn btn-outline-secondary btn-sm me-1">Editar</a>
                                        <form action="{{ route('felines.desactivate', $feline) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-outline-warning btn-sm me-1">Despublicar Michi</button>
                                        </form>
                                        <form action="{{ route('felines.destroy', $feline) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este michi?')">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No tienes michis publicados.</p>
            @endif
        </div>

        {{-- Columna de michis no publicados --}}
        <div class="col-md-6">
            <h3 class="mb-3">Michis no publicados</h3>

            @if ($felines->where('in_active', 0)->isNotEmpty())
                <div class="row">
                    @foreach ($felines->where('in_active', 0) as $feline)
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm border-0 h-100">
                                <img src="{{ asset('images/colognes/adver/' . $feline->photo) }}"
                                     class="card-img-top rounded-top"
                                     alt="{{ $feline->name }}"
                                     style="height: 200px; object-fit: cover;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="card-title text-primary">{{ $feline->name }}</h5>
                                        <p class="mb-1"><strong>Edad:</strong> {{ $feline->age }} años</p>
                                        <p class="mb-1"><strong>Raza:</strong> {{ $feline->race }}</p>
                                        <p class="mb-1"><strong>Sexo:</strong> {{ $feline->sex }}</p>
                                        <p class="mb-1"><strong>Estado de salud:</strong> {{ $feline->health_status }}</p>
                                    </div>

                                    <div class="mt-3">
                                        <a href="{{ route('felines.edit', $feline) }}" class="btn btn-outline-secondary btn-sm me-1">Editar</a>
                                        <a href="{{ route('advertisement.create', $feline) }}" class="btn btn-outline-primary btn-sm me-1">Publicar Michi</a>
                                        <form action="{{ route('felines.destroy', $feline) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este michi?')">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No tienes michis no publicados.</p>
            @endif
        </div>
    </div>
</div>

@endsection
