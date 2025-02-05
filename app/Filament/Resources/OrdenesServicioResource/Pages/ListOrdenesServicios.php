<?php

namespace App\Filament\Resources\OrdenesServicioResource\Pages;

use App\Filament\Resources\OrdenesServicioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrdenesServicios extends ListRecords
{
    protected static string $resource = OrdenesServicioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
