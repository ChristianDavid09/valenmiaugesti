<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('logo/icon.red.jpg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">


    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">
    <title>@yield('title')</title>
</head>
<body>
    @include('partials.nav')

    @yield('content')

    @include('partials.footer')
</body>
</html>

