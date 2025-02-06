<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculos extends Model
{
    use HasFactory;

    protected $table = 'vehiculos';

    protected $fillable = [
        'marca',
        'modelo',
        'color',
        'placa',
        'tipo_vehiculo',
        'año',
        'cliente_id',
        'numero_chasis',
        'numero_motor',
    ];

    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'cliente_id'); // Ajusta el nombre de la columna de la clave foránea si es diferente
    }
}
