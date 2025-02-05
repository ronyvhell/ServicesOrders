<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TecnicosResource\Pages;
use App\Filament\Resources\TecnicosResource\RelationManagers;
use App\Models\Tecnicos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TecnicosResource extends Resource
{
    protected static ?string $model = Tecnicos::class;

    protected static ?string $navigationIcon = 'heroicon-o-users'; // Icono del Módulo
    protected static ?string $navigationLabel = 'Tecnicos'; // Título del Módulo 
    protected static ?string $navigationGroup = 'Configuración'; // Dividir Módulos en Grupos
    protected static ?int $navigationSort = 4; // Orden de Aparición en el Menú

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('especialidad')
                    ->required()
                    ->maxLength(191),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('especialidad')
                    ->searchable(),
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
            'index' => Pages\ListTecnicos::route('/'),
            'create' => Pages\CreateTecnicos::route('/create'),
            'edit' => Pages\EditTecnicos::route('/{record}/edit'),
        ];
    }
}
