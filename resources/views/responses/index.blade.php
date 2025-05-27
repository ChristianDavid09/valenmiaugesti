@extends('layout')
@section('title', 'Respuestas a mensajes')


@section('content')
<style>
    .chat-container {
        max-width: 700px;
        margin: 2rem auto;
        padding: 20px;
        background-color: #f0f2f5;
        border-radius: 10px;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    .chat-header {
        background-color: #e1e7eb;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        margin-bottom: 30px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .message-wrapper {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-bottom: 20px;
    }

    .message-bubble {
        padding: 12px 18px;
        border-radius: 20px;
        max-width: 75%;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        word-wrap: break-word;
    }

    .message-left {
        background-color: #ffffff;
        align-self: flex-start;
        border-radius: 20px 20px 20px 5px;
    }

    .message-right {
        background-color: #dcf8c6;
        align-self: flex-end;
        border-radius: 20px 20px 5px 20px;
    }

    .message-meta {
        font-size: 0.75rem;
        color: #666;
        margin-top: 5px;
    }

    .chat-form {
        margin-top: 15px;
    }

    .chat-form .form-control {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .chat-form .btn {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }
</style>


    <div class="chat-container">

        {{-- Encabezado del mensaje centrado --}}
        <div class="chat-header">
            <h5><strong>{{ $message->adopter?->name ?? 'Adoptante desconocido' }}</strong></h5>
            <p class="mb-1">{{ $message->content }}</p>
            <small class="text-muted">{{ $message->created_at->format('d/m/Y H:i') }}</small>
        </div>

        {{-- Respuestas tipo chat --}}
        @foreach ($message->responses->sortBy('created_at') as $response)
            <div class="message-wrapper">
                <div class="message-bubble {{ $response->user_id === Auth::id() ? 'message-right' : 'message-left' }}">
                    <strong>{{ $response->user?->name ?? 'Usuario desconocido' }}</strong><br>
                    {{ $response->content }}
                    <div class="message-meta">{{ $response->created_at->format('d/m/Y H:i') }}</div>
                </div>
            </div>
        @endforeach

        {{-- Formulario de respuesta --}}
        <form action="{{ route('responses.store') }}" method="POST" class="chat-form">
            @csrf
            <input type="hidden" name="message_id" value="{{ $message->id }}">
            <div class="input-group">
                <input type="text" name="content" class="form-control" placeholder="Escribe tu mensaje..." required>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
    </div>




@endsection

