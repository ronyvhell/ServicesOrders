<?php

namespace App\Filament\Resources\ClientesRecurrentesResource\Pages;

use App\Filament\Resources\ClientesRecurrentesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Cliente;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EditClientesRecurrentes extends EditRecord
{
    protected static string $resource = ClientesRecurrentesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}
