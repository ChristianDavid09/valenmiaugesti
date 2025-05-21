@extends('layout')

@section('title', 'Enviar Mensaje')

@section('content')
<div class="container">
    <h1>Enviar Mensaje</h1>

    <form action="{{ route('messages.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="recipient" class="form-label">Destinatario</label>
            <input type="text" class="form-control" id="recipient" name="recipient" required>
        </div>
        <div class="mb-3">
            <label for="subject" class="form-label">Asunto</label>
            <input type="text" class="form-control" id="subject" name="subject" required>
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Cuerpo del Mensaje</label>
            <textarea class="form-control" id="body" name="body" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>





@endsection
