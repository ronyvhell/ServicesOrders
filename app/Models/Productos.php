<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Productos extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'imagen',
    ];

    public function ordenesServicio(): BelongsToMany
    {
        return $this->belongsToMany(OrdenesServicio::class, 'ordenes_servicio_producto', 'producto_id', 'orden_servicio_id');
    }
}
