@extends('layout')
@section('title', 'Publicaciones')

@section('content')
    <div class="container">
        <h1>Publicaciones</h1>
        <div class="row">
            @foreach ($publications as $publication)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ asset('storage/' . $publication->image) }}" class="card-img-top" alt="{{ $publication->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $publication->title }}</h5>
                            <p class="card-text">{{ $publication->description }}</p>
                            <p class="card-text"><small class="text-muted">Publicado por {{ $publication->user->name }} el {{ $publication->created_at->format('d/m/Y') }}</small></p>
                            <a href="{{ route('publications.show', $publication->id) }}" class="btn btn-primary">Ver más</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $publications->links() }}
        </div>
    </div>

@endsection
