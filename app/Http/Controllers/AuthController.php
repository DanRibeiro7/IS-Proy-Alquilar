<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class AuthController extends Controller
{
    public function mostrarLogin()
    {
        return view('auth.login');
    }

    public function verificarLogin(Request $request)
{
    $request->validate([
        'nombre' => 'required',
        'numero_tarjeta' => 'required',
        'pin' => 'required',
    ]);

    $usuario = Usuario::where('UsuNombre', $request->nombre)
        ->where('UsuNumero_tarjeta', $request->numero_tarjeta)
        ->where('UsuPin', $request->pin)
        ->first();

    if (!$usuario) {
        return back()->withErrors(['credenciales' => 'Nombre, número de tarjeta o PIN incorrecto']);
    }

    session(['usuario_id' => $usuario->UsuID]);

    if ($usuario->UsuSaldo < 5) {
        return redirect()->route('recargar');
    }

    return redirect()->route('menu');
}

    public function recargarVista()
    {
        $usuario = Usuario::find(session('usuario_id'));
        return view('usuario.recargar', compact('usuario'));
    }

    public function menuVista()
    {
        $usuario = Usuario::find(session('usuario_id'));
        return view('usuario.menu', compact('usuario'));
    }
    public function procesarRecarga(Request $request)
{
    $request->validate([
        'monto' => 'required|numeric|min:1',
    ]);

    $usuario = Usuario::find(session('usuario_id'));

    $usuario->UsuSaldo += $request->monto;
    $usuario->save();

    return redirect()->route('menu')->with('mensaje', 'Recarga exitosa. Tu nuevo saldo es: S/ ' . number_format($usuario->UsuSaldo, 2));
}

}

