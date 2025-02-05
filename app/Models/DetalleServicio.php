<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleServicio extends Model
{
    protected $table = 'detalle_servicios';

    protected $fillable = [
        'orden_id',
        'fallas_reportadas',
        'procedimientos_autorizados',
        'verificacion_fluidos',
    ];

    public function ordenServicio()
    {
        return $this->belongsTo(OrdenesServicio::class, 'orden_id');
    }
}
