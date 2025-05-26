@extends('layout')
@section('title', 'Adoptante')

@section('content')
    <div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <h2 class="text-center mb-4">👤 Detalle del adoptante</h2>

            @if (session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card shadow rounded-4 border-0">
                <div class="card-body p-4 bg-white">

                    {{-- Imagen del adoptante --}}
                    <div class="text-center mb-4">
                        @if ($adopter->photo_url)
                            <img src="{{ asset('storage/' . $adopter->photo_url) }}" class="rounded-circle shadow" alt="Foto del adoptante" width="120" height="120">
                        @else
                            <img src="{{ asset('./images/adopters/profile/'.$adopter->photo) }}" class="rounded-circle shadow" alt="Foto por defecto" width="120" height="120">
                        @endif
                    </div>

                    {{-- Datos del adoptante --}}
                    <div class="mb-4 border-bottom pb-3 text-center">
                        <h5 class="mb-1 text-primary">👤 {{ $adopter->name }}</h5>
                        <small class="text-muted">{{ $adopter->created_at->format('d/m/Y H:i') }}</small>
                    </div>

                    <p><span class="fw-bold">📧 Correo:</span> {{ $adopter->user->email }}</p>
                    <p><span class="fw-bold">📞 Teléfono:</span> {{ $adopter->phone }}</p>
                    <p><span class="fw-bold">📅 Fecha de registro:</span> {{ $adopter->created_at->format('d/m/Y') }}</p>
                    <p><span class="fw-bold">📄 Descripción:</span> {{ $adopter->description?? 'Sin descripción' }}</p>

                    {{-- Certificado de delitos --}}
                    @if ($adopter->certificate)
                        <div class="mt-4">
                            <a href="{{ asset('./certificates/' . $adopter->certificate) }}" target="_blank" class="btn btn-outline-success w-100">
                                📄 Ver certificado de delitos penales
                            </a>
                        </div>
                    @else
                        <div class="alert alert-warning text-center mt-4">
                            ⚠️ El adoptante aún no ha subido el certificado de delitos penales.
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>


@endsection