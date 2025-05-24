@extends('layout')

@section('title', 'Mensaje')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <h2 class="text-center mb-4">📨 Detalle del mensaje</h2>

                @if (session('success'))
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card shadow rounded-4 border-0">
                    <div class="card-body p-4 bg-white">
                        <div class="mb-4 border-bottom pb-3">
                            <a href=""><h5 class="mb-1 text-primary">👤 De: {{ $message->adopter->name ?? 'Sin adoptante' }}</h5></a>
                            <small class="text-muted">{{ $message->created_at->format('d/m/Y H:i') }}</small>
                        </div>

                        <p><span class="fw-bold">📌 Tipo:</span> {{ ucfirst($message->type) }}</p>

                        <div class="bg-light p-3 rounded mb-3">
                            <p class="mb-1 text-muted fw-bold">📝 Mensaje:</p>
                            <p class="mb-0">{{ $message->content }}</p>
                        </div>

                        <p><span class="fw-bold">📍 Colonia:</span> {{ $message->cologne->name ?? 'Sin colonia' }}</p>
                        <p><span class="fw-bold">🐱 Michi:</span> {{ $message->advertisement->feline->name ?? 'Sin michi' }}</p>
                        <p><span class="fw-bold">📤 Estado:</span> {{ ucfirst($message->status) }}</p>

                        <div class="mt-4 bg-light p-3 rounded">
                            <p class="mb-1 text-muted fw-bold">📬 Respuesta:</p>
                            <p class="mb-2">{{ $message->response ?? 'No hay respuesta aún' }}</p>
                            <small class="text-muted">
                                {{ $message->response_date ? $message->response_date->format('d/m/Y H:i') : 'No respondido' }}
                            </small>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('responses.index') }}" class="btn btn-outline-primary">
                                Responder a este mensaje
                            </a>
                            <a href="{{ route('messages.index') }}" class="btn btn-outline-primary">
                                ← Volver a mensajes
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
