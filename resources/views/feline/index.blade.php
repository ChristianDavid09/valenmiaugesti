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
            @if ($felines->isNotEmpty())
                @foreach ($felines as $feline)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm h-100 border-0">
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
            @else
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        No hay michis registrados en tu colonia.
                    </div>
                </div>
            @endif
        </div>
    </div>




@endsection
