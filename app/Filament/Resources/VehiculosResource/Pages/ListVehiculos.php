<?php

namespace App\Filament\Resources\VehiculosResource\Pages;

use App\Filament\Resources\VehiculosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVehiculos extends ListRecords
{
    protected static string $resource = VehiculosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
