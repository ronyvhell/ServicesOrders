<?php

namespace App\Filament\Resources\DatosTallerResource\Pages;

use App\Filament\Resources\DatosTallerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDatosTallers extends ListRecords
{
    protected static string $resource = DatosTallerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
