@extends('layout')

@section('title', 'Anuncios')

@section('content')
    <div class="container my-5">

        <div class="row">
            @if ($advertisements->isNotEmpty())
                @foreach ($advertisements as $adver)
                    <div class="col-md-4 mb-4 d-flex">
                        <div class="card shadow-sm h-100 border-0">
                            <a href="{{ route('advertisement.show', $adver) }}">
                                <img src="{{ asset('images/colognes/adver/' . $adver->feline->photo) }}"
                                     class="card-img-top rounded-top"
                                     alt="{{ $adver->title }}"
                                     style="height: 200px; object-fit: cover;">
                            </a>
                            <div class="card-body">
                                <a href="{{ route('advertisement.show', $adver) }}" class="text-decoration-none text-dark">
                                    <h5 class="card-title text-primary">{{ $adver->title }}</h5>
                                </a>
                                <p class="card-text mb-1">{{ $adver->description }}</p>
                                <div class="d-flex align-items-center mb-2">
                                    <span class="status-dot {{
                                        $adver->type == 'Disponible' ? 'bg-success' :
                                        ($adver->type == 'En acogida' ? 'bg-warning' : 'bg-secondary')
                                    }}"></span>
                                    <strong class="ms-2">Disponibilidad:&nbsp;</strong> {{ $adver->type }}
                                </div>
                                @if (Auth::user()->rol == 'Cologne')
                                    <a href="{{ route('advertisement.edit', $adver) }}" class="btn btn-outline-secondary btn-sm me-1">Editar</a>
                                    <form action="{{ route('advertisement.destroy', $adver) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Eliminar</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        No hay anuncios disponibles.
                    </div>
                </div>
            @endif
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
