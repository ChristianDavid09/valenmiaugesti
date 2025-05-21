@extends('layout')

@section('title', 'Cuenta')

@section('content')
    <div class="container">
        <h1>Mi cuenta</h1>
        <p>Bienvenido a tu cuenta, {{ Auth::user()->name }}.</p>

        <h2>Detalles de la cuenta</h2>
        <ul>
            <li><strong>{{ Auth::user()->rol }}:</strong></li>{{ Auth::user()->cologne->name }}
        </ul>
        <ul>
            <li><strong>Nombre:</strong> {{ Auth::user()->name }}</li>
            <li><strong>Email:</strong> {{ Auth::user()->email }}</li>
            <li><strong>Fecha de creación:</strong> {{ Auth::user()->created_at->format('d/m/Y') }}</li>
        </ul>

        <h2>Acciones</h2>
        @if (Auth::user()->rol == 'adoptante')
            <a href="{{ route('account.edit', Auth::user() ) }}" class="btn btn-primary">Editar cuenta</a>
        @else
            <button type="button" class="btn btn-primary" id="button">Editar</button>
            <div id="buttons" style="display: none;">
                <a href="{{ route('account.edit', Auth::user() ) }}" class="btn btn-primary">Editar Datos de Administrador</a>
                <a href="{{ route('colognes.edit', Auth::user()->cologne) }}" class="btn btn-primary">Editar Datos de Colonia</a>
            </div>
        @endif

    </div>

    <script>
        var button = document.getElementById('button');
        var buttons = document.getElementById('buttons');

        button.addEventListener('click', function () {
            buttons.style.display = 'block';
            button.style.display = 'none';
        });
    </script>

@endsection
