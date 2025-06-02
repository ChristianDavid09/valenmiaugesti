{{--  Barra de navegación de todas las paginas
    Esta barra de navegación se muestra en todas las páginas del sitio web, y se adapta según el estado de autenticación del usuario. --}}
  <header class="p-3 mb-3 border-bottom">
    <div class="container">

      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start" id="navbarNav">

        @if (!Auth::check())
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                <img class="bi me-2" width="40" height="40" src="{{ asset('logo/icon.red.jpg') }}" alt="logo">
            </a>
        @else
            <a href="{{ route('colognes.index') }}" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                <img class="bi me-2" width="40" height="40" src="{{ asset('logo/icon.red.jpg') }}" alt="logo">
            </a>
        @endif
        @if (!Auth::check())
            <div class="ms-auto d-flex gap-2">
              <a class="btn btn-outline-primary" href="{{ route('signUp') }}">Registrarse</a>
              <a class="btn btn-primary" href="{{ route('loginForm') }}">Iniciar Sesión</a>
            </div>
            @else
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                @if (Auth::user()->rol == 'Cologne')
                    <li><a class="nav-link" href="{{ route('colognes.show', Auth::user()->cologne) }}">Mi Colonia</a></li>
                    <li><a class="nav-link" href="{{ route('felines.index') }}">Mis Michis</a></li>
                    <li><a class="nav-link" href="{{ route('advertisement.index') }}">Mis Anuncios</a></li>
                @else
                    <li><a class="nav-link" href="{{ route('advertisement.index') }}">Anuncios</a></li>
                @endif
                <li><a href="{{ route('colognes.index') }}" class="nav-link px-2 link-dark" >Colonias</a></li>
                <li><a href="{{ route('publications.index') }}" class="nav-link px-2 link-dark">Foro</a></li>
                <li><a href="{{ route('messages.index') }}" class="nav-link px-2 link-dark">Mensajes</a></li>
            </ul>

            {{-- <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
              <input type="search" class="form-control" placeholder="Buscar..." aria-label="Buscar">
            </form> --}}

            <div class="dropdown text-end">
                <a href="#" class="d-block text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    @if (Auth::user()->rol == 'Cologne')
                        <img src="{{ asset('./images/colognes/profile/'.Auth::user()->photo_url) }}" alt="Perfil" width="42" height="42" class="rounded-circle border shadow-sm" style="object-fit: cover;">
                    @else
                        <img src="{{ asset('./images/adopters/profile/'.Auth::user()->photo_url) }}" alt="Perfil" width="42" height="42" class="rounded-circle border shadow-sm" style="object-fit: cover;">
                    @endif

                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownUser1">
                  <li><h6 class="dropdown-header">{{ Auth::user()->name }}</h6></li>
                  <li><a class="dropdown-item" href="{{ route('account') }}">Cuenta</a></li>
                  <li><a class="dropdown-item" href="{{ route('messages.index') }}">Correo</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item text-danger" href="{{ route('logout') }}">Cerrar Sesión</a></li>
                </ul>
              </div>
        @endif
      </div>
    </div>
  </header>
