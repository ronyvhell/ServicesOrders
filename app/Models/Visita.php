<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    protected $fillable = ['cliente_recurrente_id', 'fecha', 'servicio', 'comentarios'];

    public function clienteRecurrente()
    {
        return $this->belongsTo(ClientesRecurrentes::class);
    }
}
