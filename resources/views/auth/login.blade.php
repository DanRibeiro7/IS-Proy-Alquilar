@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="container mt-5">
    <h2>Iniciar Sesión</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('verificar.login') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" class="form-control" required value="{{ old('nombre') }}">
        </div>

        <div class="mb-3">
            <label for="numero_tarjeta" class="form-label">Número de Tarjeta:</label>
            <input type="text" name="numero_tarjeta" class="form-control" required value="{{ old('numero_tarjeta') }}">
        </div>

        <div class="mb-3">
            <label for="pin" class="form-label">PIN:</label>
            <input type="password" name="pin" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>
</div>
@endsection
