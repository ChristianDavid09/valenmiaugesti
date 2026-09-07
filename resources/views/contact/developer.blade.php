@extends('layout')

@section('title', 'Contactar al desarrollador')

@section('content')
<div class="container my-5">

    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            {{-- Título --}}
            <div class="text-center mb-4">
                <h1 class="fw-bold text-primary">
                    <i class="bi bi-headset"></i>
                    Contactar al desarrollador
                </h1>

                <p class="text-muted">
                    ¿Has encontrado un problema o necesitas ayuda?
                    Cuéntame qué ocurre y te ayudaré lo antes posible.
                </p>
            </div>

            {{-- Mensajes --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ session('error') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                    </button>
                </div>
            @endif

            {{-- Formulario --}}
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4 p-md-5">

                    <form action="{{ route('contact.send') }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf

                        {{-- Motivo --}}
                        <div class="mb-4">
                            <label for="type" class="form-label fw-semibold">
                                <i class="bi bi-list-check me-1"></i>
                                Motivo de contacto
                            </label>

                            <select name="type"
                                    id="type"
                                    class="form-select form-select-lg @error('type') is-invalid @enderror"
                                    required>

                                <option value="" selected disabled>
                                    Selecciona un motivo...
                                </option>

                                <option value="problemas_tecnicos">
                                    Problemas técnicos
                                </option>

                                <option value="plan">
                                    Plan
                                </option>

                                <option value="error_registro">
                                    Error en el registro
                                </option>

                                <option value="error_inicio_sesion">
                                    Error al iniciar sesión
                                </option>

                                <option value="otros">
                                    Otros
                                </option>
                            </select>

                            @error('type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Mensaje --}}
                        <div class="mb-4">
                            <label for="message" class="form-label fw-semibold">
                                <i class="bi bi-chat-left-text me-1"></i>
                                Describe el problema
                            </label>

                            <textarea name="message"
                                      id="message"
                                      rows="6"
                                      class="form-control @error('message') is-invalid @enderror"
                                      placeholder="Describe detalladamente qué ha ocurrido..."
                                      required>{{ old('message') }}</textarea>

                            @error('message')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Imagen --}}
                        <div class="mb-4">
                            <label for="image" class="form-label fw-semibold">
                                <i class="bi bi-image me-1"></i>
                                Captura de pantalla
                                <span class="text-muted fw-normal">(opcional)</span>
                            </label>

                            <input type="file"
                                   name="image"
                                   id="image"
                                   class="form-control @error('image') is-invalid @enderror"
                                   accept="image/jpeg,image/png,image/webp">

                            <div class="form-text">
                                <i class="bi bi-info-circle me-1"></i>
                                Puedes adjuntar una captura de pantalla.
                                Formatos permitidos: JPG, PNG o WEBP. Máximo 5 MB.
                            </div>

                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        {{-- Botón --}}
                        <div class="d-grid">
                            <button type="submit"
                                    class="btn btn-primary btn-lg rounded-3">
                                <i class="bi bi-send-fill me-2"></i>
                                Enviar mensaje
                            </button>
                        </div>

                    </form>

                </div>
            </div>

            {{-- Información adicional --}}
            <div class="text-center mt-4">
                <small class="text-muted">
                    También puedes contactar directamente en
                    <a href="mailto:valenmiaugesti@gmail.com">
                        valenmiaugesti@gmail.com
                    </a>
                </small>
            </div>

        </div>
    </div>

</div>
@endsection