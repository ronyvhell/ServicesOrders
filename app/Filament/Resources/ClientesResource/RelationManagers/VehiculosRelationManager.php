<?php

namespace App\Filament\Resources\ClientesResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class VehiculosRelationManager extends RelationManager
{
    protected static string $relationship = 'vehiculos';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('marca')->label('Marca'),
                Tables\Columns\TextColumn::make('modelo')->label('Modelo'),
                Tables\Columns\TextColumn::make('placa')->label('Placa'),
                Tables\Columns\TextColumn::make('año')->label('Año'),
                Tables\Columns\TextColumn::make('color')->label('Color'),
            ])
            ->filters([])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
