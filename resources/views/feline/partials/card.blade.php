<div class="mb-4">
    <div class="card shadow-sm border-0 h-100">
        <img src="{{ asset('images/colognes/felines/' . $feline->photo) }}"
             class="card-img-top rounded-top"
             alt="{{ $feline->name }}"
             style="height: 200px; object-fit: cover;">

        <div class="card-body d-flex flex-column justify-content-between">
            <div>
                <a href="{{ route('felines.show', $feline) }}" class="text-decoration-none text-dark">
                    <h5 class="card-title text-primary">{{ $feline->name }}</h5>
                </a>
                <ul class="list-unstyled">
                    <li><strong>Edad:</strong> {{ $feline->age ?? 'Desconocido' }} años</li>
                    <li><strong>Raza:</strong> {{ ucfirst($feline->race) }}</li>
                    <li><strong>Sexo:</strong> {{ $feline->sex }}</li>
                    <li><strong>Esterilizado:</strong> {{ $feline->sterilized === 'Yes' ? 'Sí' : 'No' }}</li>
                    <li><strong>Salud:</strong> {{ $feline->health_status }}</li>
                </ul>
            </div>

            <div class="mt-3 d-flex flex-wrap gap-2">
                <a href="{{ route('felines.edit', $feline) }}" class="btn btn-outline-secondary btn-sm">Editar</a>

                @if($isActive)
                    <form action="{{ route('advertisement.destroy', $feline->advertisement) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-warning btn-sm">Despublicar</button>
                    </form>
                @else
                    <a href="{{ route('advertisement.create', $feline) }}" class="btn btn-outline-primary btn-sm">Publicar</a>
                @endif

                <form action="{{ route('felines.destroy', $feline) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este michi?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger btn-sm">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
