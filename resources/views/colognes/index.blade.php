@extends('layout')

@section('title', 'Colonias')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4 text-center">Colonias</h1>
        <div class="row">
            @if ($colognes->isNotEmpty())
                @foreach ($colognes as $cologne)
                    <div class="col-md-4 mb-4 d-flex">
                        <div class="card shadow-sm border-0 w-100" style="height: 100%; min-height: 400px;">
                            <a href="{{ route('colognes.show', $cologne) }}">
                                <div style="height: 200px; overflow: hidden;">
                                    <img src="{{ asset('images/colognes/profile/' . $cologne->photo) }}"
                                         class="card-img-top w-100"
                                         alt="{{ $cologne->name }}"
                                         style="height: 100%; object-fit: cover;">
                                </div>
                            </a>
                            <div class="card-body">
                                <a href="{{ route('colognes.show', $cologne) }}" class="text-decoration-none text-dark">
                                    <h5 class="card-title text-primary">{{ $cologne->name }}</h5>
                                </a>
                                <div>
                                    <p class="card-text mb-2">
                                        <strong>Descripción:</strong>
                                        {{ \Illuminate\Support\Str::limit($cologne->description, 80) }}
                                    </p>
                                    <p class="card-text">
                                        <strong>Dirección:</strong> {{ $cologne->adress }}
                                    </p>
                                    <p class="card-text">
                                        <strong>Telefono:</strong> {{ $cologne->phone }}
                                    </p>
                                    <p class="card-text">
                                        <strong>Administrador:</strong> {{ $cologne->user->name }}
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        No hay colonias registradas.
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
