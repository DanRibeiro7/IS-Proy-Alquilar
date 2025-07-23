<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'UsuID';
    public $timestamps = false;

    protected $fillable = ['UsuNombre', 'UsuNumero_tarjeta', 'UsuPin', 'UsuSaldo'];

    public function alquileres()
    {
        return $this->hasMany(Alquiler::class, 'UsuID');
    }

    public function recargas()
    {
        return $this->hasMany(Recarga::class, 'UsuID');
    }
}

