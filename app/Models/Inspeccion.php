<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspeccion extends Model
{
    protected $table = 'inspeccions';

    protected $fillable = [
        'orden_id',
        'fallas_detectadas',
        'objetos_valor',
        'documentos_vehiculo',
    ];

    public function ordenServicio()
    {
        return $this->belongsTo(OrdenesServicio::class, 'orden_id');
    }
}
