<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiciosResource\Pages;
use App\Filament\Resources\ServiciosResource\RelationManagers;
use App\Models\Servicios;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiciosResource extends Resource
{
    protected static ?string $model = Servicios::class;

    // Edición Módulo
    protected static ?string $navigationIcon = 'heroicon-o-wrench'; // Icono del Módulo
    protected static ?string $navigationLabel = 'Servicios'; // Título del Módulo 
    protected static ?string $navigationGroup = 'Inventario y Servicios'; // Dividir Módulos en Grupos
    protected static ?int $navigationSort = 3; // Orden de Aparición en el Menú

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('descripcion')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('precio')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('descripcion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('precio')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServicios::route('/'),
            'create' => Pages\CreateServicios::route('/create'),
            'edit' => Pages\EditServicios::route('/{record}/edit'),
        ];
    }
}
