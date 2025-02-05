<?php

namespace App\Filament\Resources\TecnicosResource\Pages;

use App\Filament\Resources\TecnicosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTecnicos extends EditRecord
{
    protected static string $resource = TecnicosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
