<?php

namespace App\Filament\Resources\TecnicosResource\Pages;

use App\Filament\Resources\TecnicosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTecnicos extends ListRecords
{
    protected static string $resource = TecnicosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
