<?php

namespace App\Filament\Resources\VehiculosResource\Pages;

use App\Filament\Resources\VehiculosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVehiculos extends EditRecord
{
    protected static string $resource = VehiculosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
