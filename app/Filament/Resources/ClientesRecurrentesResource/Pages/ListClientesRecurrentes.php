<?php

namespace App\Filament\Resources\ClientesRecurrentesResource\Pages;

use App\Filament\Resources\ClientesRecurrentesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClientesRecurrentes extends ListRecords
{
    protected static string $resource = ClientesRecurrentesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
