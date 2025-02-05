<?php

namespace App\Filament\Resources\OrdenesServicioResource\Pages;

use App\Filament\Resources\OrdenesServicioResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrdenesServicio extends EditRecord
{
    protected static string $resource = OrdenesServicioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
