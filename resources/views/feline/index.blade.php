@extends('layout')

@section('title', 'Michis')

@section('content')
<div class="container my-5">
    <h1 class="mb-4 text-center">Michis de mi Colonia</h1>

    <div class="row mb-4">
        <div class="col text-center">
            <a href="{{ route('felines.create') }}" class="btn btn-primary">Dar de alta a un Michi</a>
        </div>
    </div>

    <div class="row">
        {{-- Michis Publicados --}}
        <div class="col-md-6 border-end border-2 border-secondary">
            <h3 class="text-center mb-4">Michis publicados</h3>

            @forelse ($activeFelines as $feline)
                @include('feline.partials.card', ['feline' => $feline, 'isActive' => true])
            @empty
                <p class="text-center">No tienes michis publicados.</p>
            @endforelse

            <div class="d-flex justify-content-center mt-3">
                {{ $activeFelines->links() }}
            </div>
        </div>

        {{-- Michis No Publicados --}}
        <div class="col-md-6">
            <h3 class="text-center mb-4">Michis no publicados</h3>

            @forelse ($inactiveFelines as $feline)
                @include('feline.partials.card', ['feline' => $feline, 'isActive' => false])
            @empty
                <p class="text-center">No tienes michis no publicados.</p>
            @endforelse

            <div class="d-flex justify-content-center mt-3">
                {{ $inactiveFelines->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
