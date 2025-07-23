@extends('layouts.app')

@section('title', 'Menú Principal')

@section('content')
<h1>Bienvenido, {{ $usuario->UsuNombre }}</h1>
<p>Saldo actual: S/. {{ number_format($usuario->UsuSaldo, 2) }}</p>

<ul>
    <li><a href="{{ route('peliculas.index') }}">Alquilar Película</a></li>
    <li><a href="{{ route('historial') }}">Ver Historial</a></li>
</ul>
@endsection
