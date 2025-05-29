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
                            <a href="{{ route('adopters.show', $message->adopter->id) }}" style="text-decoration:none;">
                                <h5 class="mb-1 text-primary">
                                    <img src="{{ asset('./images/adopters/profile/'.$message->adopter->user->photo_url) }}" class="rounded-circle shadow" width="120" height="120">
                                    {{ $message->adopter->name ?? 'Sin adoptante' }}
                                </h5>
                            </a>
                            <small class="text-muted">{{ $message->created_at->format('d/m/Y H:i') }}</small>
                        </div>

                        <p><span class="fw-bold">📌 Tipo:</span> {{ ucfirst($message->type) }}</p>

                        <div class="bg-light p-3 rounded mb-3">
                            <p class="mb-1 text-muted fw-bold">📝 Mensaje:</p>
                            <p class="mb-0">{{ $message->content }}</p>
                        </div>

                        <p><span class="fw-bold">📍 Colonia:</span>
                            <a href="{{ route('colognes.show', $message->cologne) }}" style="text-decoration:none;">
                                {{ $message->cologne->name ?? 'Sin colonia' }}
                            </a>
                        </p>
                        <p>
                            <span class="fw-bold">🐱 Michi:</span>
                            <a href="{{ route('felines.show', $message->advertisement->feline) }}" style="text-decoration:none;">
                                {{ $message->advertisement->feline->name ?? 'Sin michi' }}
                            </a>
                        </p>
                        <p><span class="fw-bold">📤 Estado:</span> {{ ucfirst($message->status) }}</p>
                        @if (Auth::user()->rol === 'Cologne')
                            @if ($message->status === 'Pendiente')
                                <form action="{{ route('messages.updateStatus', $message->id) }}" method="POST" class="mt-4">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="En proceso">
                                    <button type="submit" class="btn btn-warning w-100">🔄 Marcar como "En proceso"</button>
                                </form>
                            @elseif ($message->status === 'En proceso')
                                <form action="{{ route('messages.updateStatus', $message->id) }}" method="POST" class="mt-4">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="Resuelto">
                                    <button type="submit" class="btn btn-success w-100">✅ Marcar como "Resuelto"</button>
                                </form>
                            @endif
                        @endif
                        <div class="mt-4 bg-light p-3 rounded">
                            <p class="mb-1 text-muted fw-bold">📬 Respuesta:</p>
                            <p class="mb-2">
                                @if ($message->responses->isNotEmpty())
                                    ✅ Este mensaje ya tiene respuestas.
                                @else
                                    No hay respuestas aún.
                                @endif
                            </p>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('responses.forMessage', $message->id) }}" class="btn btn-outline-primary">
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
