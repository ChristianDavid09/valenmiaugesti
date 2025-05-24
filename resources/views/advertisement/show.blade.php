@extends('layout')

@section('title', 'Anuncio')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4 text-center">Anuncio: {{ $advertisement->title }}</h1><br>

        <div class="card shadow-lg p-3 mb-5 bg-body rounded">
            <div class="row g-0 align-items-center">
                <div class="col-md-4 text-center p-3">
                    <img src="{{ asset('images/colognes/adver/' . $advertisement->feline->photo) }}"
                         alt="{{ $advertisement->title }}"
                         class="img-fluid rounded"
                         style="max-height: 250px; object-fit: cover;">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $advertisement->title }}</h5>
                        <p class="card-text">{{ $advertisement->description }}</p>
                        <strong>Tipo:</strong>
                        <span class="status-dot {{ $advertisement->type == 'Disponible' ? 'bg-success' : ($advertisement->type == 'En acogida' ? 'bg-warning' : 'bg-secondary') }}">
                        </span>&nbsp;{{ $advertisement->type }}<br>
                        <strong>Colonia:&nbsp;</strong>{{ $advertisement->feline->cologne->name }}
                        <hr>
                        <p class="card-text">
                            <strong>Nombre del michi:</strong> {{ $advertisement->feline->name }}<br>
                            <strong>Edad</strong>: {{ $advertisement->feline->age }}<br>
                            <strong>Sexo:</strong> {{ $advertisement->feline->sex }}<br>
                            <strong>Raza:</strong> {{ $advertisement->feline->race }}<br>
                            <strong>Estado de salud:</strong> {{ $advertisement->feline->health_status }}<br>
                        </p>
                        <a href="{{ route('messages.create.for', [
                                        'feline' => $advertisement->feline,
                                        'cologne' => $advertisement->feline->cologne
                                ]) }}" type="button" class="btn btn-outline-primary btn-sm me-1">Enviar mensaje
                        </a>
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
