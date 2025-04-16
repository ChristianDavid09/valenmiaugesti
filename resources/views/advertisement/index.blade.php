@extends('layout')

@section('title', 'Anuncios')

@section('content')
        @foreach ($anuncios as $anuncio)
            <div>
                
                <h2>{{ $anuncio->titulo }}</h2>
                <p>{{ $anuncio->descripcion }}</p>
            </div>
            
        @endforeach
@endsection
