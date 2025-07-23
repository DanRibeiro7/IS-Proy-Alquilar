<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Películas')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <nav>
            @if(session('usuario_id'))
                <a href="{{ route('menu') }}">Inicio</a>
                <a href="{{ route('recargar') }}">Recargar</a>
                <a href="{{ route('logout') }}">Cerrar sesión</a>
            @endif
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
