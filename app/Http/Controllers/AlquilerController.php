<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alquiler;
use App\Models\Usuario;
use App\Models\Pelicula;

class AlquilerController extends Controller
{
    public function historial()
    {
        $usuario = Usuario::find(session('usuario_id'));

        $alquileres = Alquiler::with('pelicula')
            ->where('UsuID', $usuario->UsuID)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('usuario.historial', compact('usuario', 'alquileres'));
    }
    public function alquilar(Request $request, $id)
{
    $usuario = session('usuario');

    // Buscar la película por ID
    $pelicula = Pelicula::findOrFail($id);

    // Verificar saldo
    if ($usuario->UsuSaldo < $pelicula->PelPrecio) {
        return redirect()->route('peliculas.index')->with('mensaje', 'Saldo insuficiente para alquilar esta película.');
    }

    // Registrar alquiler
    Alquiler::create([
        'UsuID' => $usuario->UsuID,
        'PelID' => $pelicula->PelID,
        'AlqFecha' => now(),
        'AlqPrecio' => $pelicula->PelPrecio
    ]);

    // Descontar saldo
    $usuario->UsuSaldo -= $pelicula->PelPrecio;
    $usuario->save();

    // Actualizar sesión
    session(['usuario' => $usuario]);

    return redirect()->route('menu')->with('mensaje', 'Película alquilada correctamente.');
}

}
