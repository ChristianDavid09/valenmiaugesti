@extends('layout')


@section('title', 'Michis')

@section('content')

<div class="container">
    <h1>Michis de mi Colonia</h1>

    <div class="row">
        @foreach ($felines as $feline)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('./colonias/images/anuncios/'. $feline->photo) }}" class="card-img-top" alt="{{ $feline->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $feline->name }}</h5>
                        <p class="card-text">Edad: {{ $feline->age }} años</p>
                        <p class="card-text">Raza: {{ $feline->race }}</p>
                        <a href="{{ route('felinos.edit', $feline) }}" class="btn btn-secondary">Editar</a>
                        <a href="{{ route('adver.create', $feline) }}" class="btn btn-secondary">Publicar Michi</a>
                        <form action="{{ route('felinos.destroy', $feline) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
    <a href="{{ route('felinos.create') }}" class="btn btn-primary">Dar de alta a un Michi</a>


@endsection
