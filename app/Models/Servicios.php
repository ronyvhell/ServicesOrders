<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Servicios extends Model
{
    protected $table = 'servicios';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
    ];

    /**
     * Define la relación muchos a muchos con el modelo OrdenesServicio.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ordenesServicio(): BelongsToMany
    {
        return $this->belongsToMany(OrdenesServicio::class, 'ordenes_servicio_servicio', 'servicio_id', 'orden_servicio_id');
    }
}
