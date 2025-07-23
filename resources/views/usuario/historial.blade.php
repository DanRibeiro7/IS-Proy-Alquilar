<!DOCTYPE html>
<html>
<head>
    <title>Historial de Alquileres</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Historial de Alquileres de {{ $usuario->UsuNombre }}</h2>

    @if($alquileres->isEmpty())
        <div class="alert alert-info mt-4">No has alquilado ninguna película aún.</div>
    @else
        <table class="table table-bordered mt-4">
            <thead class="table-dark">
                <tr>
                    <th>Película</th>
                    <th>Precio</th>
                    <th>Fecha de Alquiler</th>
                </tr>
            </thead>
            <tbody>
            @foreach($alquileres as $alquiler)
                <tr>
                    <td>{{ $alquiler->pelicula->PelTitulo }}</td>
                    <td>S/. {{ number_format($alquiler->pelicula->PelPrecio, 2) }}</td>
                    <td>{{ \Carbon\Carbon::parse($alquiler->created_at)->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('menu') }}" class="btn btn-secondary mt-3">Volver al Menú</a>
</div>
</body>
</html>
