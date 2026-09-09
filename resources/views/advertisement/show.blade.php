@extends('layout')

@section('title', 'Anuncio')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4 text-center">Anuncio: {{ $adver->title }}</h1><br>

        <div class="card shadow-lg p-3 mb-5 bg-body rounded">
            <div class="row g-0 align-items-center">
                <div class="col-md-4 text-center p-3">
                    <img src="{{ Storage::disk('s3')->url('colognes/felines/' . $adver->feline->photo) }}"
                         alt="{{ $adver->title }}"
                         class="img-fluid rounded"
                         style="max-height: 250px; object-fit: cover;">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $adver->title }}</h5>
                        <p class="card-text">{{ $adver->description }}</p>
                        <strong>Tipo:</strong>
                        <span class="status-dot
                            {{ $adver->type == 'Disponible' ? 'bg-success' :
                                ($adver->type == 'En acogida' ? 'bg-warning' : 'bg-danger')
                            }}">
                        </span>&nbsp;{{ $adver->type }}<br>
                        <strong>Colonia:&nbsp;</strong>
                        <a href="{{ route('colognes.show', $adver->feline->cologne) }}" class="text-decoration-none text-primary">
                            {{ $adver->feline->cologne->name }}
                        </a><br>
                        <hr>
                        <p class="card-text">
                            <strong>Nombre:</strong>
                            <a href="{{ route('felines.show', $adver->feline) }}" class="text-decoration-none text-primary">
                                {{ $adver->feline->name }}
                            </a><br>
                            <strong>Edad</strong>: {{ $adver->feline->age }}<br>
                            <strong>Sexo:</strong> {{ $adver->feline->sex }}<br>
                            <strong>Raza:</strong> {{ $adver->feline->race }}<br>
                            <strong>Estado de salud:</strong> {{ $adver->feline->health_status }}<br>
                            <Strong>Esterilizado:</strong> {{ $adver->feline->sterilized == 'Yes' ? 'Sí' : 'No' }}<br>
                        </p>
                        @if (Auth::user()->rol === 'Adopter')
                            <a href="{{ route('messages.create.for', [
                                'feline' => $adver->feline,
                                'cologne' => $adver->feline->cologne
                                ]) }}" type="button" class="btn btn-outline-primary btn-sm me-1">Enviar mensaje
                            </a>
                        @endif

                    </div>
                </div>
            </div>
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
