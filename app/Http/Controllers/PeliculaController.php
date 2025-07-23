<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;
use App\Models\Usuario;
use App\Models\Alquiler;

class PeliculaController extends Controller
{
    public function index()
    {
        $peliculas = Pelicula::all();
        return view('peliculas.index', compact('peliculas'));
    }

    public function alquilar($id)
    {
        $usuario = Usuario::find(session('usuario_id'));
        $pelicula = Pelicula::findOrFail($id);

        if ($usuario->UsuSaldo < $pelicula->PelPrecio) {
            return back()->with('mensaje', 'Saldo insuficiente para alquilar esta película.');
        }

        if ($pelicula->PelStock < 1) {
            return back()->with('mensaje', 'No hay stock disponible para esta película.');
        }

        // Descontar saldo y stock
        $usuario->UsuSaldo -= $pelicula->PelPrecio;
        $usuario->save();

        $pelicula->PelStock -= 1;
        $pelicula->save();

        // Registrar el alquiler
        Alquiler::create([
            'UsuID' => $usuario->UsuID,
            'PelID' => $pelicula->PelID,
        ]);

        return back()->with('mensaje', 'Película alquilada correctamente.');
    }
}
