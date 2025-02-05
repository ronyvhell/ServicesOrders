<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductosResource\Pages;
use App\Models\Productos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;

class ProductosResource extends Resource
{
    protected static ?string $model = Productos::class;

    // Edición Módulo
    protected static ?string $navigationIcon = 'heroicon-o-archive-box'; // Icono del Módulo
    protected static ?string $navigationLabel = 'Productos'; // Título del Módulo 
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
                Forms\Components\FileUpload::make('imagen') // Cambiado a FileUpload
                    ->label('Imagen')
                    ->image() // Define que es un archivo de imagen
                    ->directory('productos') // Carpeta donde se guardarán las imágenes
                    ->maxSize(1024) // Tamaño máximo del archivo en KB (opcional)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg']), // Tipos de archivos permitidos
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
                ImageColumn::make('imagen') // Cambiado a ImageColumn para mostrar la imagen
                    ->label('Imagen')
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
            'index' => Pages\ListProductos::route('/'),
            'create' => Pages\CreateProductos::route('/create'),
            'edit' => Pages\EditProductos::route('/{record}/edit'),
        ];
    }
}
