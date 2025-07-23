@extends('layouts.app')

@section('title', 'Películas Disponibles')

@section('content')
<div class="container mt-5">
    <h2>Películas Disponibles para Alquilar</h2>

    @if(session('mensaje'))
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif

    <table class="table table-bordered mt-4">
        <thead class="table-dark">
            <tr>
                <th>Título</th>
                <th>Género</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($peliculas as $peli)
            <tr>
                <td>{{ $peli->PelNombre }}</td>
                <td>{{ $peli->PelTipo }}</td>
                <td>S/. {{ number_format($peli->PelCosto, 2) }}</td>
                <td>
                    <form action="{{ route('peliculas.alquilar', $peli->PelID) }}" method="POST">
                        @csrf
                        <button class="btn btn-primary btn-sm" type="submit">Alquilar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="{{ route('menu') }}" class="btn btn-secondary mt-3">Volver al Menú</a>
</div>
@endsection
