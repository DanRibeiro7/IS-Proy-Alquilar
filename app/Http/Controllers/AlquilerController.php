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

    $pelicula = Pelicula::findOrFail($id);

    // Verificar stock
    if ($pelicula->PelStock <= 0) {
        return redirect()->route('peliculas.index')->with('mensaje', 'No hay stock disponible para esta película.');
    }

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
    session(['usuario' => $usuario]);

    // Descontar stock
    $pelicula->PelStock -= 1;
    $pelicula->save();

    return redirect()->route('menu')->with('mensaje', 'Película alquilada correctamente.');
}


}
