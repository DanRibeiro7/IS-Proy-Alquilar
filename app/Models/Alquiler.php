<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alquiler extends Model
{
    protected $table = 'alquileres';
    protected $primaryKey = 'AlqID';
    public $timestamps = false;

    protected $fillable = ['UsuID', 'PelID', 'AlqEnlace', 'AlqEstado'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'UsuID');
    }

    public function pelicula()
    {
        return $this->belongsTo(Pelicula::class, 'PelID');
    }
}
