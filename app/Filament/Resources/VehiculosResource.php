<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehiculosResource\Pages;
use App\Models\Vehiculos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Resources\VehiculosResource\RelationManagers;

class VehiculosResource extends Resource
{
    protected static ?string $model = Vehiculos::class;

    // Edición Módulo
    protected static ?string $navigationIcon = 'heroicon-o-folder'; // Icono del Módulo
    protected static ?string $navigationLabel = 'Vehículos'; // Título del Módulo 
    protected static ?string $navigationGroup = 'Clientes y Vehículos'; // Dividir Módulos en Grupos
    protected static ?int $navigationSort = 2; // Orden de Aparición en el Menú

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Grid::make(2)
                ->schema([
                    Forms\Components\Select::make('marca')
                        ->label('Marca')
                        ->options([
                            'Toyota' => 'Toyota',
                            'Mazda' => 'Mazda',
                            'Renault' => 'Renault',
                            'Chevrolet' => 'Chevrolet',
                            'Kia' => 'Kia',
                            'Nissan' => 'Nissan',
                            'Hyundai' => 'Hyundai',
                            'Volkswagen' => 'Volkswagen',
                            'Ford' => 'Ford',
                            'Suzuki' => 'Suzuki',
                        ])
                        ->reactive()
                        ->required(),
                    Forms\Components\Select::make('modelo')
                        ->label('Modelo')
                        ->options(function (callable $get) {
                            $marca = $get('marca');
                            $modelos = [
                                'Toyota' => ['Corolla' => 'Corolla', 'Hilux' => 'Hilux', 'Fortuner' => 'Fortuner', 'Yaris' => 'Yaris', 'RAV4' => 'RAV4'],
                                'Mazda' => ['Mazda 2' => 'Mazda 2', 'Mazda 3' => 'Mazda 3', 'CX-30' => 'CX-30', 'CX-5' => 'CX-5'],
                                'Renault' => ['Duster' => 'Duster', 'Kwid' => 'Kwid', 'Stepway' => 'Stepway', 'Logan' => 'Logan', 'Sandero' => 'Sandero'],
                                'Chevrolet' => ['Onix' => 'Onix', 'Tracker' => 'Tracker', 'Joy' => 'Joy', 'Spark' => 'Spark'],
                                'Kia' => ['Picanto' => 'Picanto', 'Sportage' => 'Sportage', 'Rio' => 'Rio', 'Seltos' => 'Seltos'],
                                'Nissan' => ['Versa' => 'Versa', 'Sentra' => 'Sentra', 'Kicks' => 'Kicks', 'Frontier' => 'Frontier'],
                                'Hyundai' => ['Accent' => 'Accent', 'Tucson' => 'Tucson', 'Kona' => 'Kona', 'Elantra' => 'Elantra'],
                                'Volkswagen' => ['Gol' => 'Gol', 'T-Cross' => 'T-Cross', 'Jetta' => 'Jetta', 'Polo' => 'Polo'],
                                'Ford' => ['Escape' => 'Escape', 'Ranger' => 'Ranger', 'Explorer' => 'Explorer', 'Edge' => 'Edge'],
                                'Suzuki' => ['Swift' => 'Swift', 'Vitara' => 'Vitara', 'S-Cross' => 'S-Cross', 'Jimny' => 'Jimny'],
                            ];
                            return $modelos[$marca] ?? [];
                        })
                        ->required(),
                    Forms\Components\TextInput::make('año')
                        ->label('Año')
                        ->numeric()
                        ->required(),
                    Forms\Components\TextInput::make('color')
                        ->label('Color')
                        ->required(),
                    Forms\Components\TextInput::make('placa')
                        ->label('Placa')
                        ->required()
                        ->maxLength(191),
                    Forms\Components\Select::make('tipo_vehiculo')
                        ->label('Tipo de Vehículo')
                        ->options([
                            'Automóvil' => 'Automóvil',
                            'Camioneta' => 'Camioneta',
                            'Camión' => 'Camión',
                            'Motocicleta' => 'Motocicleta',
                            'Bus' => 'Bus',
                            'Furgoneta' => 'Furgoneta',
                            'SUV' => 'SUV',
                        ])
                        ->required(),
                    Forms\Components\TextInput::make('numero_chasis') 
                        ->label('Número de Chasis')
                        ->maxLength(191),
                    Forms\Components\TextInput::make('numero_motor') 
                        ->label('Número de Motor')
                        ->maxLength(191),
                    Forms\Components\Select::make('cliente_id')
                        ->label('Dueño del Vehículo')
                        ->relationship('cliente', 'nombre') // Usa la relación definida en el modelo
                        ->searchable() // Permite buscar por nombre
                        ->preload() // Precarga las opciones
                        ->createOptionForm([
                            Forms\Components\TextInput::make('nombre')
                                ->required()
                                ->maxLength(191),
                            Forms\Components\TextInput::make('apellido')
                                ->required()
                                ->maxLength(191),
                            Forms\Components\TextInput::make('email')
                                ->email()
                                ->required()
                                ->maxLength(191),
                            Forms\Components\TextInput::make('telefono')
                                ->tel()
                                ->required()
                                ->maxLength(191),
                            Forms\Components\TextInput::make('documento_identidad')
                                ->required()
                                ->maxLength(191),
                        ])
                        ->createOptionAction(function (Forms\Components\Actions\Action $action) {
                            return $action
                                ->modalHeading('Crear Nuevo Cliente')
                                ->modalButton('Crear Cliente')
                                ->modalWidth('lg');
                        }),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('marca')->searchable(),
                Tables\Columns\TextColumn::make('modelo')->searchable(),
                Tables\Columns\TextColumn::make('color')->searchable(),
                Tables\Columns\TextColumn::make('placa')->searchable(),
                Tables\Columns\TextColumn::make('tipo_vehiculo')->searchable(),
                Tables\Columns\TextColumn::make('cliente.nombre')
                ->label('Dueño')
                ->searchable()
                ->badge()
                ->color('primary')
                ->icon('heroicon-o-user')
                ->getStateUsing(function ($record) {
                    // Verifica si el cliente existe y devuelve nombre completo
                    return $record->cliente 
                        ? $record->cliente->nombre . ' ' . $record->cliente->apellido 
                        : 'Sin dueño asignado';
                }),
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
            RelationManagers\ClienteRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehiculos::route('/'),
            'create' => Pages\CreateVehiculos::route('/create'),
            'edit' => Pages\EditVehiculos::route('/{record}/edit'),
        ];
    }
}
