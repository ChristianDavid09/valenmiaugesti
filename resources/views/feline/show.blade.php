@extends('layout')

@section('title', 'Ficha del Michi')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">Ficha de {{ $feline->name }}</h1>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <img src="{{ asset('images/colognes/felines/' . $feline->photo) }}"
                         alt="Foto de {{ $feline->name }}"
                         class="card-img-top"
                         style="height: 400px; object-fit: cover;">

                    <div class="card-body">
                        <h4 class="card-title text-primary">{{ $feline->name }}</h4>

                        <ul class="list-group list-group-flush mb-3">
                            @if($feline->age == null)
                                <li class="list-group-item"><strong>Edad:</strong>&nbsp;Desconocido</li>
                            @else
                                <li class="list-group-item"><strong>Edad:</strong> {{ $feline->age }} años</li>
                            @endif
                            <li class="list-group-item"><strong>Raza:</strong> {{ $feline->race }}</li>
                            <li class="list-group-item"><strong>Sexo:</strong> {{ $feline->sex }}</li>
                            <li class="list-group-item"><strong>Estado de salud:</strong> {{ $feline->health_status }}</li>
                            <li class="list-group-item"><strong>Esterilizado:</strong> {{ $feline->sterilized == 'Yes' ? 'Sí' : 'No' }}</li>
                            @if(Auth::user()->rol === 'Cologne')
                                <li class="list-group-item">
                                    <strong>Estado de publicación:</strong>
                                    @if ($feline->in_active)
                                        <span class="text-success">Publicado</span>
                                    @else
                                        <span class="text-secondary">No publicado</span>
                                    @endif
                                </li>
                            @endif
                        </ul>
                        @if ($isOwner)
                            <a href="{{ route('felines.edit', $feline) }}" class="btn btn-warning me-2">Editar</a>
                            <a href="{{ route('felines.index') }}" class="btn btn-secondary">Michis</a>
                        @endif
                        <a href="{{ route('advertisement.index') }}" class="btn btn-secondary">Volver a Anuncios</a>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
