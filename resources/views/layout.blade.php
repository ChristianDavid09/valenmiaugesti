<?php 
/**
 * @author: David
 * @version: 1.1
 * @since 
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('logo/icon.red.jpg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" >


    <link href="assets/css/main.css" rel="stylesheet">
    <title>@yield('title')</title>
</head>
<body>
    @include('partials.nav')

    @yield('content')

    @include('partials.footer')
</body>
</html>


{{-- 
/**
 * @author: David
 * @version: 1.1
 * @since
*/

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="{{ asset('logo/icon.red.jpg') }}" type="image/x-icon">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">


    <title>@yield('title')</title>
</head>

<body>

    @include('partials.nav')

    @yield('content')

    @include('partials.footer')


     AVISO DE COOKIES 
    <div id="cookieBanner"
         class="position-fixed bottom-0 start-0 w-100 p-3"
         style="z-index: 1050; display: none;">

        <div class="container">
            <div class="alert alert-dark shadow-lg mb-0">

                <div class="d-flex flex-column flex-md-row
                            justify-content-between align-items-md-center gap-3">

                    <div>
                        <strong>🍪 Utilizamos cookies</strong>

                        <p class="mb-0 mt-1">
                            Utilizamos cookies necesarias para el funcionamiento
                            de la aplicación.
                            Puedes consultar más información en nuestra
                            <a href="{{ route('privacyPolicy') }}"
                               class="alert-link">
                                Política de privacidad
                            </a>.
                        </p>
                    </div>

                    <div class="d-flex gap-2 flex-shrink-0">

                        <button id="rejectCookies"
                                class="btn btn-outline-light">
                            Rechazar
                        </button>

                        <button id="acceptCookies"
                                class="btn btn-primary">
                            Aceptar
                        </button>

                    </div>

                </div>

            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const cookieBanner = document.getElementById('cookieBanner');
            const acceptButton = document.getElementById('acceptCookies');
            const rejectButton = document.getElementById('rejectCookies');

            // Mostrar el aviso si todavía no existe una decisión
            if (!localStorage.getItem('cookiesDecision')) {
                cookieBanner.style.display = 'block';
            }

            // Aceptar
            acceptButton.addEventListener('click', function () {

                localStorage.setItem('cookiesDecision', 'accepted');

                cookieBanner.style.display = 'none';
            });

            // Rechazar
            rejectButton.addEventListener('click', function () {

                localStorage.setItem('cookiesDecision', 'rejected');

                cookieBanner.style.display = 'none';
            });

        });
    </script>

</body>
</html> --}}

