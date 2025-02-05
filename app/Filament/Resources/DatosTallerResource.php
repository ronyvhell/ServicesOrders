<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DatosTallerResource\Pages;
use App\Filament\Resources\DatosTallerResource\RelationManagers;
use App\Models\DatosTaller;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DatosTallerResource extends Resource
{
    protected static ?string $model = DatosTaller::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern'; // Icono del Módulo
    protected static ?string $navigationLabel = 'Datos del Taller'; // Título del Módulo 
    protected static ?string $navigationGroup = 'Configuración'; // Dividir Módulos en Grupos
    protected static ?int $navigationSort = 4; // Orden de Aparición en el Menú

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre_taller')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('direccion')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('telefono')
                    ->tel()
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('iva')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('comision')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre_taller')
                    ->searchable(),
                Tables\Columns\TextColumn::make('direccion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telefono')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('iva')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('comision')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListDatosTallers::route('/'),
            'create' => Pages\CreateDatosTaller::route('/create'),
            'edit' => Pages\EditDatosTaller::route('/{record}/edit'),
        ];
    }
}
