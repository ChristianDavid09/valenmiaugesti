@extends('layout')

@section('title', 'Mis Publicaciones')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary">👤 Mis publicaciones</h2>
            <a href="{{ route('publications.create') }}" class="btn btn-success">
                ➕ Nueva publicación
            </a>
        </div>

        @if ($publications->isEmpty())
            <p class="text-muted">No has publicado nada todavía.</p>
        @else
            <div class="row g-4">
                @foreach ($publications as $publication)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm card-publication">
                            <div class="card-body d-flex flex-column">
                                <div class="mb-2">
                                    <strong>{{ Auth::user()->name }}</strong><br>
                                    <small class="text-muted">{{ $publication->created_at->format('d/m/Y H:i') }}</small>
                                </div>

                                <p class="publication-content text-muted mb-2">{{ $publication->content }}</p>
                                <div class="text-center mt-2">
                                    <img src="{{ asset('pubs/photo/' . $publication->photo) }}"
                                         class="img-fluid publication-img"
                                         alt="Imagen de la publicación">
                                </div>
                                <div class="mt-3 d-flex justify-content-between">
                                    <a href="{{ route('publications.edit', $publication) }}" class="btn btn-sm btn-outline-secondary">✏️ Editar</a>

                                    <form action="{{ route('publications.destroy', $publication) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta publicación?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">🗑️ Eliminar</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <style>
        .card-publication {
            border-radius: 15px;
            overflow: hidden;
            transition: box-shadow 0.3s ease-in-out;
            height: 100%;
        }

        .card-publication:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .publication-img {
            max-height: 200px;
            object-fit: cover;
            border-radius: 10px;
            width: 100%;
        }

        .publication-content {
            font-size: 0.9rem;
        }
    </style>
@endsection
