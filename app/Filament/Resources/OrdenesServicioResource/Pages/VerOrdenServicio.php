<?php

namespace App\Filament\Resources\OrdenesServicioResource\Pages;

use App\Filament\Resources\OrdenesServicioResource;
use Filament\Resources\Pages\ViewRecord;

class VerOrdenServicio extends ViewRecord
{
    protected static string $resource = OrdenesServicioResource::class;

    public function getView(): string
    {
        return 'components.orden-servicio-detalle'; // Ruta a la vista del componente Blade
    }
}

