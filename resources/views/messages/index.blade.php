@extends('layout')

@section('title', 'Mensajes')

@section('content')
    <div class="container my-5">
        <h2 class="text-center mb-4">📨 Mensajes</h2>

        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if ($messages->isEmpty())
            <div class="alert alert-info text-center">
                No tienes mensajes.
            </div>
        @else
            <div class="list-group shadow">
                @foreach ($messages as $message)
                    <a href="{{ route('messages.show', $message->id) }}"
                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ $message->status === 'unread' ? 'fw-bold' : '' }}">
                        <div>
                            <div class="small text-muted">{{ $message->type }} — {{ $message->created_at->format('d/m/Y H:i') }}</div>
                            <div>{{ Str::limit($message->content, 80) }}</div>
                        </div>
                        <span class="badge bg-{{ $message->status === 'Pendiente' ? 'secondary' : ($message->status === 'En proceso' ? 'primary' : 'success' ) }}">
                            {{ $message->status }}
                        </span>
                    </a>
                @endforeach
            </div>
        @endif
    </div>


@endsection
