<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatosTaller extends Model
{
    // Cambia a 'datos_tallers' para que coincida con la base de datos
    protected $table = 'datos_tallers';

    protected $fillable = [
        'nombre_taller',
        'direccion',
        'telefono',
        'email',
        'iva',
        'comision',
    ];
}
