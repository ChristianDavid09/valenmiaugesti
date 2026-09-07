<h2>Nuevo mensaje de contacto</h2>

<p>
    <strong>Usuario:</strong> {{ $userName }}
</p>

<p>
    <strong>Email:</strong>
    <a href="mailto:{{ $userEmail }}">
        {{ $userEmail }}
    </a>
</p>

<hr>

<p>
    <strong>Motivo:</strong> {{ $type }}
</p>

<p>
    <strong>Mensaje:</strong>
</p>

<p>
    {!! nl2br(e($contactMessage)) !!}
</p>

<hr>

<p>
    Este mensaje ha sido enviado desde la aplicación de Michis.
</p>