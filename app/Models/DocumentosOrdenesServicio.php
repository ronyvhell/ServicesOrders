<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentosOrdenesServicio extends Model
{
    protected $table = 'documentos_ordenes_servicio';

    protected $fillable = [
        'orden_servicio_id',
        'tipo_documento',
        'documento_path',
    ];

    public function ordenServicio()
    {
        return $this->belongsTo(OrdenesServicio::class, 'orden_servicio_id');
    }
}
