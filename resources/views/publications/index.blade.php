@extends('layout')
@section('title', 'Publicaciones')

@section('content')


    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary">📰 Últimas publicaciones</h2>
            <div class="d-flex gap-2">
                <a href="{{ route('publications.myPub') }}" class="btn btn-outline-primary">
                    👤 Mis publicaciones
                </a>
                <a href="{{ route('publications.create') }}" class="btn btn-success">
                    ➕ Nueva publicación
                </a>
            </div>
        </div>


        <div class="row g-4">
            @foreach ($publications as $publication)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm card-publication">
                        <div class="card-body d-flex flex-column">

                            @if(Auth::check() &&  $publication->user->cologne)
                                {{-- Título de la publicación --}}
                                <div class="d-flex align-items-center mb-2">
                                    <img src="{{ asset('images/colognes/profile/' . $publication->user->photo_url) }}"
                                         class="me-2 profile-img">
                                    <div>
                                        <strong><a href="{{ route('colognes.show', $publication->user->cologne) }}" style="text-decoration:none;">{{ $publication->user->name }}</a></strong><br>
                                        <small class="text-muted">{{ $publication->created_at->format('d/m/Y H:i') }}</small>
                                    </div>
                                </div>
                            @elseif (Auth::check() && $publication->user->adopter)
                                {{-- Mostrar nombre y foto del usuario si es un adoptante --}}
                                <div class="d-flex align-items-center mb-2">
                                    <img src="{{ asset('images/adopters/profile/' . $publication->user->photo_url) }}"
                                         class="me-2 profile-img">
                                    <div>
                                        <strong><a href="{{ route('adopters.show', $publication->user->adopter) }}" style="text-decoration:none;">{{ $publication->user->name }}</a></strong><br>
                                        <small class="text-muted">{{ $publication->created_at->format('d/m/Y H:i') }}</small>
                                    </div>
                                </div>
                            @endif

                            {{-- Contenido --}}
                            <p class="publication-content text-muted mb-2">{{$publication->content}}</p>

                            {{-- Imagen debajo del texto --}}
                            @if ($publication->photo)
                                <div class="text-center mt-auto">
                                    <img src="{{ asset('pubs/photo/' . $publication->photo) }}"
                                         class="img-fluid publication-img"
                                         alt="Imagen de la publicación">
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
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

        .profile-img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #ddd;
        }

        .publication-title {
            font-size: 1rem;
            font-weight: bold;
        }

        .publication-content {
            font-size: 0.9rem;
        }
    </style>
@endsection
