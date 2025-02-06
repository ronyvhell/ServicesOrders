<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Clientes;

class ClientesRecurrentes extends Model
{
    protected $table = 'clientes_recurrentes';

    protected $fillable = [
        'cliente_id', 
        'total_visitas', 
        'ultimo_servicio', 
        'tipo_servicio', 
        'fecha_ultima_visita'
    ];

    // Relación con el modelo Cliente
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Clientes::class, 'cliente_id');
    }

    public function visitas()
    {
        return $this->hasMany(Visita::class);
    }

    // Asegúrate de que el nombre de la relación coincida con el nombre utilizado en el recurso
    public function ordenesServicio()
    {
        return $this->hasMany(OrdenesServicio::class, 'cliente_id', 'id');
    }
}
