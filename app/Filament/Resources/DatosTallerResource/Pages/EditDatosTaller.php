<?php

namespace App\Filament\Resources\DatosTallerResource\Pages;

use App\Filament\Resources\DatosTallerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDatosTaller extends EditRecord
{
    protected static string $resource = DatosTallerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
