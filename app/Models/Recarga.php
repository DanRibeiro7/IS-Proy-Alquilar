<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recarga extends Model
{
    protected $table = 'recargas';
    protected $primaryKey = 'RecID';
    public $timestamps = false;

    protected $fillable = ['UsuID', 'RecMonto'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'UsuID');
    }
}
