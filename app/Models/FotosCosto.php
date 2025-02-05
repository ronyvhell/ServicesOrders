<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotosCosto extends Model
{
    protected $table = 'fotos_costos';

    protected $fillable = [
        'orden_id',
        'foto_frente',
        'foto_lateral_izquierdo',
        'foto_lateral_derecho',
        'foto_atras',
        'comentarios',
    ];

    public function ordenServicio()
    {
        return $this->belongsTo(OrdenesServicio::class, 'orden_id');
    }
}
