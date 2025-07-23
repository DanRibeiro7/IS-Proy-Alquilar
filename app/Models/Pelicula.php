<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    protected $table = 'peliculas';
    protected $primaryKey = 'PelID';
    public $timestamps = false;

   protected $fillable = ['PelNombre', 'PelTipo', 'PelDuracion', 'PelCosto', 'PelStock'];


    public function alquileres()
    {
        return $this->hasMany(Alquiler::class, 'PelID');
    }
}
