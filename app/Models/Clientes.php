<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    protected $table = 'clientes'; // Asegura que usa el nombre correcto de la tabla

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'direccion',
        'documento_identidad',
    ];

    /**
     * Relación: Un cliente puede tener muchos vehículos.
     */
    public function vehiculos()
    {
        return $this->hasMany(Vehiculos::class, 'cliente_id');
    }
}
