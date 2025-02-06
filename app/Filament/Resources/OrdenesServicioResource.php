<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrdenesServicioResource\Pages;
use App\Models\OrdenesServicio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Wizard;
use Filament\Tables\Actions\Action as TableAction; // Alias para las acciones de tabla
use Filament\Forms\Components\Actions\Action as FormAction; // Alias para las acciones de formulario
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\ToggleButtons;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Support\Collection;
use Filament\Notifications\Notification;
use App\Models\Vehiculos;

class OrdenesServicioResource extends Resource
{
    protected static ?string $model = OrdenesServicio::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Órdenes de Servicio';
    protected static ?string $navigationGroup = 'Gestión de órdenes';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\Wizard::make([
                    Wizard\Step::make('Información Básica')
                        ->schema([
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\Select::make('cliente_id')
                                        ->label('Cliente')
                                        ->searchable()
                                        ->relationship('cliente', 'nombre', function ($query) {
                                            return $query->select('id', 'nombre', 'apellido');
                                        })
                                        ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->nombre} {$record->apellido}")
                                        ->afterStateUpdated(function (callable $set, $state) {
                                            // Buscar el primer vehículo del cliente
                                            $vehiculo = \App\Models\Vehiculos::where('cliente_id', $state)->first();
                                            
                                            if ($vehiculo) {
                                                $set('vehiculo_id', $vehiculo->id);
                                            }
                                        })
                                        ->createOptionForm([
                                            Forms\Components\Grid::make(2) // Configura el grid para que tenga 2 columnas
                                                ->schema([
                                                    Forms\Components\TextInput::make('nombre')
                                                        ->label('Nombre')
                                                        ->required(),
                                                    Forms\Components\TextInput::make('apellido')
                                                        ->label('Apellido')
                                                        ->required(),
                                                    Forms\Components\TextInput::make('email')
                                                        ->label('Correo Electrónico')
                                                        ->email()
                                                        ->required(),
                                                    Forms\Components\TextInput::make('telefono')
                                                        ->label('Teléfono')
                                                        ->tel()
                                                        ->required(),
                                                    Forms\Components\TextInput::make('direccion')
                                                        ->label('Dirección')
                                                        ->required(),
                                                    Forms\Components\TextInput::make('documento_identidad')
                                                        ->label('Documento de Identidad')
                                                        ->required(),
                                                ]),
                                        ])
                                        ->createOptionModalHeading('Registrar nuevo Cliente')
                                        ->required(),
                                    Forms\Components\Select::make('vehiculo_id')
                                        ->label('Vehículo')
                                        ->searchable()
                                        ->relationship('vehiculo', 'placa')
                                        ->createOptionForm([
                                            Forms\Components\TextInput::make('placa')
                                                ->label('Placa')
                                                ->required(),
                                            Forms\Components\Grid::make(2)
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
                                                                ->searchable()
                                                                ->createOptionForm([
                                                                    Forms\Components\TextInput::make('nueva_marca')
                                                                        ->label('Nueva Marca')
                                                                        ->required(),
                                                                ])
                                                                ->createOptionModalHeading('Agregar nueva Marca')
                                                                ->createOptionUsing(function (array $data) {
                                                                    // Aquí puedes agregar la lógica para guardar la nueva marca en la base de datos
                                                                    $marca = $data['nueva_marca'];
                                                                    // Guardar la nueva marca y devolver el valor
                                                                    return $marca;
                                                                })
                                                                ->required(),
                                                            Forms\Components\Select::make('modelo')
                                                                ->label('Modelo')
                                                                ->options(function (callable $get) {
                                                                    $marca = $get('marca');
                                                                    $modelos = [
                                                                        'Toyota' => ['Corolla', 'Hilux', 'Fortuner', 'Yaris', 'RAV4'],
                                                                        'Mazda' => ['Mazda 2', 'Mazda 3', 'CX-30', 'CX-5'],
                                                                        'Renault' => ['Duster', 'Kwid', 'Stepway', 'Logan', 'Sandero'],
                                                                        'Chevrolet' => ['Onix', 'Tracker', 'Joy', 'Spark'],
                                                                        'Kia' => ['Picanto', 'Sportage', 'Rio', 'Seltos'],
                                                                        'Nissan' => ['Versa', 'Sentra', 'Kicks', 'Frontier'],
                                                                        'Hyundai' => ['Accent', 'Tucson', 'Kona', 'Elantra'],
                                                                        'Volkswagen' => ['Gol', 'T-Cross', 'Jetta', 'Polo'],
                                                                        'Ford' => ['Escape', 'Ranger', 'Explorer', 'Edge'],
                                                                        'Suzuki' => ['Swift', 'Vitara', 'S-Cross', 'Jimny'],
                                                                    ];
                                                                    return $modelos[$marca] ?? [];
                                                                })
                                                                ->searchable()
                                                                ->createOptionForm([
                                                                    Forms\Components\TextInput::make('nuevo_modelo')
                                                                        ->label('Nuevo Modelo')
                                                                        ->required(),
                                                                ])
                                                                ->createOptionModalHeading('Agregar nuevo Modelo')
                                                                ->createOptionUsing(function (array $data) {
                                                                    // Aquí puedes agregar la lógica para guardar el nuevo modelo en la base de datos
                                                                    $modelo = $data['nuevo_modelo'];
                                                                    // Guardar el nuevo modelo y devolver el valor
                                                                    return $modelo;
                                                                })
                                                                ->required(),
                                                            Forms\Components\TextInput::make('año')
                                                                ->label('Año')
                                                                ->numeric()
                                                                ->required(),
                                                            Forms\Components\TextInput::make('color')
                                                                ->label('Color')
                                                                ->required(),
                                                        ]),
                                                    Forms\Components\Select::make('tipo_vehiculo')
                                                        ->label('Tipo de Vehículo')
                                                        ->options([
                                                            'sedan' => 'Sedán',
                                                            'suv' => 'SUV',
                                                            'camioneta' => 'Camioneta',
                                                            'hatchback' => 'Hatchback',
                                                            'pickup' => 'Pickup',
                                                            'coupe' => 'Coupé',
                                                            'convertible' => 'Convertible',
                                                            'van' => 'Van',
                                                            'camion' => 'Camión',
                                                        ])
                                                        ->required(),
                                                ]),
                                        ])
                                        ->createOptionModalHeading('Registrar nuevo Vehículo')
                                        ->required(),
                                    Forms\Components\Select::make('tipo_servicio')
                                        ->label('Tipo de Servicio')
                                        ->options([
                                            'garantía' => 'Garantía',
                                            'reparación' => 'Reparación',
                                            'mantenimiento' => 'Mantenimiento',
                                        ])
                                        ->required(),
                                    Forms\Components\DateTimePicker::make('fecha_creacion')
                                        ->label('Fecha y hora de ingreso')
                                        ->required(),
                                    Forms\Components\Select::make('tecnico_id')
                                        ->label('Técnico Asignado')
                                        ->relationship('tecnico', 'nombre')
                                        ->required(),
                                    Forms\Components\TextInput::make('kilometraje')
                                        ->label('Kilometraje')
                                        ->numeric()
                                        ->required(),
                                    Forms\Components\Select::make('nivel_combustible')
                                        ->label('Nivel de Combustible')
                                        ->options([
                                            'Vacío' => 'Vacío',
                                            'Medio' => 'Medio',
                                            'Completo' => 'Completo',
                                        ])
                                        ->required(),
                                    Forms\Components\Select::make('estado')
                                        ->label('Estado')
                                        ->options([
                                            'recibido' => 'Recibido',
                                            'diagnostico' => 'En Diagnóstico',
                                            'aprobacion' => 'Esperando Aprobación',
                                            'reparacion' => 'En reparación',
                                            'entrega' => 'Listo para entrega',
                                            'entregado' => 'Entregado',
                                            'cancelado' => 'Cancelado',
                                        ])
                                        ->required(),
                                ]),
                            ]),
                    Wizard\Step::make('Detalles del Servicio')
                        ->schema([
                            Forms\Components\Grid::make(1)
                                ->schema([
                                    Forms\Components\RichEditor::make('fallas_reportadas')
                                        ->label('Fallas Reportadas')
                                        ->required()
                                        ->placeholder('Describe las fallas reportadas por el cliente'),
                                    Forms\Components\Grid::make(3)
                                        ->schema([
                                            Forms\Components\Select::make('producto_id')
                                                ->label('Productos')
                                                ->relationship('productos', 'nombre')
                                                ->searchable()
                                                ->multiple(),
                                            Forms\Components\TextInput::make('servicio')
                                                ->label('Servicio')
                                                ->required(), // Campo de texto en lugar de Select
                                            Forms\Components\TextInput::make('precio')
                                                ->label('Precio')
                                                ->numeric()
                                                ->prefix('$') // Opcional, para mostrar el símbolo de moneda
                                                ->required(),
                                        ]),
                                    Forms\Components\CheckboxList::make('procedimientos_autorizados')
                                        ->label('Procedimientos Autorizados')
                                        ->options([
                                            'Diagnóstico' => 'Diagnóstico',
                                            'Mantenimiento' => 'Mantenimiento',
                                            'Reparación' => 'Reparación',
                                        ])
                                        ->required()
                                        ->columns(3),
                                    Forms\Components\CheckboxList::make('verificacion_fluidos')
                                        ->label('Verificación de Fluidos')
                                        ->options([
                                            'Aceite' => 'Aceite',
                                            'Refrigerante' => 'Refrigerante',
                                            'Líquido de Freno' => 'Líquido de Freno',
                                        ])
                                        ->required()
                                        ->columns(3),
                                    Forms\Components\Toggle::make('autorizacion_prueba_ruta')
                                        ->label('Autorización para prueba de ruta')
                                        ->inline(false),
                                ]),
                        ]),
                        
                    Wizard\Step::make('Inspección')
                        ->schema([
                            Forms\Components\Grid::make(1)
                                ->schema([
                                    Forms\Components\RichEditor::make('fallas_detectadas')
                                        ->label('Fallas Detectadas - Nuevas')
                                        ->required()
                                        ->placeholder('Describe las fallas detectadas durante la inspección'),
                                    Forms\Components\RichEditor::make('objetos_valor')
                                        ->label('Objetos de Valor Reportados')
                                        ->placeholder('Objetos de valor encontrados en el vehículo'),
                                    Forms\Components\CheckboxList::make('documentos_vehiculo')
                                        ->label('Documentos del Vehículo')
                                        ->options([
                                            'Tarjeta de Propiedad' => 'Tarjeta de Propiedad',
                                            'SOAT' => 'SOAT',
                                            'Tecnomecánica' => 'Tecnomecánica',
                                        ])
                                        ->required()
                                        ->columns(3),
                                ]),
                        ]),
                    Wizard\Step::make('Fotografías')
                        ->schema([
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\FileUpload::make('foto_frente')
                                        ->label('Fotografía 1')
                                        ->downloadable()
                                        ->acceptedFileTypes(['image/jpeg', 'image/png'])
                                        ->maxSize(9024)
                                        ->extraAttributes([
                                            'accept' => 'image/*',
                                            'capture' => 'environment', // Usar la cámara trasera
                                        ]),
                                    Forms\Components\FileUpload::make('foto_atras')
                                        ->label('Fotografía 2')
                                        ->downloadable()
                                        ->acceptedFileTypes(['image/jpeg', 'image/png'])
                                        ->maxSize(9024)
                                        ->extraAttributes([
                                            'accept' => 'image/*',
                                            'capture' => 'environment', // Usar la cámara trasera
                                        ]),
                                    Forms\Components\FileUpload::make('foto_lateral_izquierdo')
                                        ->label('Fotografía 3')
                                        ->downloadable()
                                        ->acceptedFileTypes(['image/jpeg', 'image/png'])
                                        ->maxSize(9024)
                                        ->extraAttributes([
                                            'accept' => 'image/*',
                                            'capture' => 'environment', // Usar la cámara trasera
                                        ]),
                                    Forms\Components\FileUpload::make('foto_lateral_derecho')
                                        ->label('Fotografía 4')
                                        ->downloadable()
                                        ->acceptedFileTypes(['image/jpeg', 'image/png'])
                                        ->maxSize(9024)
                                        ->extraAttributes([
                                            'accept' => 'image/*',
                                            'capture' => 'environment', // Usar la cámara trasera
                                        ]),
                                ]),
                        ]),
                    Wizard\Step::make('Documentos')
                        ->schema([
                            Forms\Components\FileUpload::make('orden_servicio')
                                ->label('Órden de Servicio')
                                ->directory('documentos_ordenes')
                                ->storeFileNamesIn('documento_path')
                                ->downloadable()
                                ->afterStateUpdated(function ($state, $set) {
                                    $set('tipo_documento', 'orden_servicio');
                                }),
                            Forms\Components\FileUpload::make('orden_salida')
                                ->label('Orden de Salida')
                                ->directory('documentos_ordenes')
                                ->storeFileNamesIn('documento_path')
                                ->downloadable()
                                ->afterStateUpdated(function ($state, $set) {
                                    $set('tipo_documento', 'orden_salida');
                                }),
                        ]),
                ])
                ->skippable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID Orden')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => 'ORD-' . $state), // Agrega el prefijo aquí
                Tables\Columns\TextColumn::make('cliente.nombre')
                    ->label('Cliente')
                    ->searchable(),
                Tables\Columns\TextColumn::make('vehiculo.placa')
                    ->label('Placa')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('tipo_servicio')
                    ->label('Tipo de Servicio')
                    ->colors([
                        'primary' => 'garantía',
                        'warning' => 'reparación',
                        'success' => 'mantenimiento',
                    ])
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'garantía' => 'Garantía',
                            'reparación' => 'Reparación',
                            'mantenimiento' => 'Mantenimiento',
                            default => 'Desconocido',
                        };
                    }),
                Tables\Columns\TextColumn::make('fecha_creacion')
                    ->label('Fecha de Ingreso')
                    ->icon('heroicon-m-calendar')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('estado')
                    ->label('Estado')
                    ->colors([
                        'primary' => 'recibido',
                        'warning' => 'diagnostico',
                        'info' => 'aprobacion',
                        'success' => 'reparacion',
                        'danger' => 'entrega',
                        'gray' => 'entregado',
                        'gray' => 'cancelado',
                    ])
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'recibido' => 'Recibido',
                            'diagnostico' => 'En Diagnóstico',
                            'aprobacion' => 'Esperando Aprobación',
                            'reparacion' => 'En reparación',
                            'entrega' => 'Listo para entrega',
                            'entregado' => 'Entregado',
                            'cancelado' => 'Cancelado',
                            default => 'Desconocido',
                        };
                    })
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('estado')
                    ->options([
                        'recibido' => 'Recibido',
                        'diagnostico' => 'En Diagnóstico',
                        'aprobacion' => 'Esperando Aprobación',
                        'reparacion' => 'En reparación',
                        'entrega' => 'Listo para entrega',
                        'entregado' => 'Entregado',
                        'cancelado' => 'Cancelado',
                    ]),
                SelectFilter::make('tipo_servicio')
                    ->options([
                        'garantía' => 'Garantía',
                        'reparación' => 'Reparación',
                        'mantenimiento' => 'Mantenimiento',
                    ]),
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                TableAction::make('ver')
                    ->label('Ver')
                    ->url(fn ($record) => static::getUrl('view', ['record' => $record->getKey()])) // Utiliza getKey() para obtener el ID
                    ->icon('heroicon-o-eye')
                    ->openUrlInNewTab(), // Opcional: abre en una nueva pestaña
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                BulkAction::make('whatsapp')
                    ->label('Enviar WhatsApp')
                    ->icon('heroicon-o-chat-bubble-left-ellipsis')
                    ->color('success')
                    ->action(function (?Collection $records) {
                        $record = $records->first();
                        $cliente = $record->cliente;

                        if (!$cliente || !$cliente->telefono) {
                            return;
                        }

                        // Generar el enlace público
                        $linkOrden = route('ordenes.public', ['public_token' => $record->public_token]);

                        // Crear el mensaje de WhatsApp
                        $mensaje = "¡Buen día!, {$cliente->nombre} {$cliente->apellido}. Puede consultar su orden de servicio en el siguiente enlace: $linkOrden";

                        // Generar el enlace de WhatsApp
                        $whatsappLink = "https://api.whatsapp.com/send?phone=57{$cliente->telefono}&text=" . urlencode($mensaje);

                        Notification::make()
                            ->title('Enlace de WhatsApp generado')
                            ->body("Haga clic en el enlace para abrir WhatsApp: <a href=\"$whatsappLink\" target=\"_blank\" class=\"text-primary-600\">Abrir WhatsApp</a>")
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->deselectRecordsAfterCompletion()
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
            'index' => Pages\ListOrdenesServicios::route('/'),
            'create' => Pages\CreateOrdenesServicio::route('/create'),
            'edit' => Pages\EditOrdenesServicio::route('/{record}/edit'),
            'view' => Pages\VerOrdenServicio::route('/{record}'), // Asegúrate de que esta línea esté presente
        ];
    }
}