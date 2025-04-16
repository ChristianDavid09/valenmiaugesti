@extends('layout')

@section('title', 'Cuenta')

@section('content')
    <div class="container">
        <h1>Mi cuenta</h1>
        <p>Bienvenido a tu cuenta, {{ Auth::user()->name }}.</p>

        <h2>Detalles de la cuenta</h2>
        <ul>
            <li><strong>{{ Auth::user()->rol }}</strong></li>
        </ul>
        <ul>
            <li><strong>Nombre:</strong> {{ Auth::user()->name }}</li>
            <li><strong>Email:</strong> {{ Auth::user()->email }}</li>
            <li><strong>Fecha de creación:</strong> {{ Auth::user()->created_at->format('d/m/Y') }}</li>
        </ul>

        <h2>Acciones</h2>
        {{-- <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">Editar cuenta</a> --}}
    </div>

@endsection
