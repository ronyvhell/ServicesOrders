<?php

namespace App\Filament\Resources\VehiculosResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ClienteRelationManager extends RelationManager
{
    protected static string $relationship = 'cliente'; // Asegúrate de que coincida con el nombre del método en el modelo Vehiculos

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Campos del formulario de cliente si es necesario
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(191),
                // Agrega más campos según sea necesario
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre'),
                Tables\Columns\TextColumn::make('apellido'),
                Tables\Columns\TextColumn::make('email'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Acciones de encabezado si son necesarias
            ])
            ->actions([
                // Acciones de fila si son necesarias
            ])
            ->bulkActions([
                // Acciones en masa si son necesarias
            ]);
    }
}
