@extends('layout')

@section('title', 'Colonias')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4 text-center">Colonias</h1>
        <div class="row">
            @if ($colognes->isNotEmpty())
                @foreach ($colognes as $cologne)
                    <div class="col-md-4 mb-4 d-flex">
                        <div class="card shadow-sm h-100 border-0">
                            <a href="{{ route('colognes.show', $cologne) }}">
                                <img src="{{ asset('images/colognes/profile/' . $cologne->photo) }}"
                                     class="card-img-top rounded-top"
                                     alt="{{ $cologne->name }}"
                                     style="height: 200px; object-fit: cover;">
                            </a>
                            <div class="card-body">
                                <a href="{{ route('colognes.show', $cologne) }}" class="text-decoration-none text-dark">
                                    <h5 class="card-title text-primary">{{ $cologne->name }}</h5>
                                </a>
                                <p class="card-text mb-1"><strong>Descripción:</strong> {{ $cologne->description }}</p>
                                <p class="card-text"><strong>Dirección:</strong> {{ $cologne->adress }}</p>
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
