@extends('layouts.app')

@section('title', 'Recargar Saldo')

@section('content')
<h1>Recargar saldo</h1>

<p>Saldo actual: S/. {{ number_format($usuario->UsuSaldo, 2) }}</p>

<form action="{{ route('recargar.saldo') }}" method="POST">
    @csrf
    <label for="monto">Monto a recargar:</label>
    <input type="number" name="monto" min="1" required>
    <button type="submit">Recargar</button>
</form>
@endsection
