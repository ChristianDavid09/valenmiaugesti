@extends('layout')

@section('title', 'ValenMiauGesti')

@section('content')
        <div class="container">
 
        <h1 class="display-5 fw-bold lh-1 mb-3 text-center">🐾 Bienvenido a ValenMiauGesti 🐾</h1>

        <div class="container col-xxl-8 px-4 py-5">
          <div class="row flex-lg-row align-items-center g-5 py-5">
            <div class="col-lg-6">
              <p class="lead mb-4">
                <strong>La plataforma para cuidar, gestionar y dar voz a los michis de nuestra ciudad.</strong>
                <br><br>
                <strong>ValenMiauGesti</strong> es una aplicación pensada para facilitar la gestión de las colonias felinas urbanas en la ciudad de Valencia, en cumplimiento con la Ley 7/2023 de Bienestar Animal.
              </p>

              <p class="fw-bold mb-2">Desde este espacio, las colonias registradas pueden:</p>
              <ul class="mb-4">
                <li>📋 Registrar a sus gatos con fotos, datos médicos y características.</li>
                <li>📢 Publicar en adopción a los felinos aptos.</li>
                <li>✉️ Comunicarse entre colonias o con adoptantes mediante mensajes.</li>
                <li>📊 Llevar un control organizado de sus animales y gestiones.</li>
              </ul>

              <p class="fw-bold mb-2">Los usuarios adoptantes pueden:</p>
              <ul class="mb-4">
                <li>🐱 Ver los gatos disponibles para adopción.</li>
                <li>❤️ Contactar con colonias para iniciar una adopción.</li>
                <li>🔄 Hacer seguimiento de su solicitud.</li>
              </ul>

              <p class="fst-italic">Porque cada michi cuenta, y juntos podemos ofrecerles una vida digna y segura.</p>

             
            </div>

            <div class="col-10 col-sm-8 col-lg-6">
                <img src="{{ asset('logo/icon.red.jpg') }}" class="d-block mx-lg-auto img-fluid rounded-circle" alt="valenmiauLogo" width="700" height="700" loading="lazy">

            </div>
          </div>
        </div>
        @if (!Auth::check())
          <div class="sign-up text-center my-5">
            <div class="row justify-content-center">
              <div class="col-md-6">
                <p class="mb-3">¿No tienes cuenta?
                  <a href="{{ route('signUp') }}" class="text-primary fw-bold">Regístrate aquí</a>
                </p>
                <p>¿Ya tienes cuenta?
                  <a href="{{ route('login') }}" class="text-primary fw-bold">Inicia sesión</a>
                </p>
              </div>
            </div>
          </div>

        @endif


@endsection
