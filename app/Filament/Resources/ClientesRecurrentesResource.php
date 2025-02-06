<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientesRecurrentesResource\Pages;
use App\Models\Clientes;
use App\Models\OrdenesServicio;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class ClientesRecurrentesResource extends Resource
{
    protected static ?string $model = Clientes::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Clientes Recurrentes';

    protected static ?string $navigationGroup = 'Clientes y Vehículos'; 

    protected static ?int $navigationSort = 4; 

    protected static ?string $navigationParentItem = 'Clientes'; 

    public static function table(Table $table): Table
    {
        return $table
            ->query(function () {
                return Clientes::select('clientes.*')
                    ->selectRaw('COUNT(os.id) as total_visitas')
                    ->selectRaw('MAX(os.fecha_creacion) as ultima_visita')
                    ->selectRaw('DATEDIFF(CURRENT_DATE, MIN(os.fecha_creacion)) / COUNT(os.id) as frecuencia_visitas')
                    ->leftJoin('ordenes_servicios as os', 'clientes.id', '=', 'os.cliente_id')
                    ->groupBy('clientes.id')
                    ->orderBy('total_visitas', 'desc');
            })
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->label('Cliente')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_visitas')
                    ->label('Total Visitas')
                    ->sortable(),
                Tables\Columns\TextColumn::make('frecuencia_visitas')
                    ->label('Frecuencia de Visitas')
                    ->formatStateUsing(function ($state) {
                        // Si no hay visitas, mostrar mensaje
                        if ($state === null || $state == 0) {
                            return 'Sin historial';
                        }

                        // Redondear a 1 decimal
                        $frecuencia = round($state, 1);

                        // Determinar descripción basada en la frecuencia
                        if ($frecuencia <= 30) {
                            $descripcion = 'Cliente muy frecuente';
                        } elseif ($frecuencia <= 60) {
                            $descripcion = 'Cliente regular';
                        } elseif ($frecuencia <= 90) {
                            $descripcion = 'Cliente ocasional';
                        } else {
                            $descripcion = 'Cliente esporádico';
                        }

                        return "{$frecuencia} días - {$descripcion}";
                    })
                    ->tooltip('Promedio de días entre visitas')
                    ->sortable(),
                Tables\Columns\TextColumn::make('ultima_visita')
                    ->label('Última Visita')
                    ->date()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('historial')
                    ->label('Ver Historial')
                    ->icon('heroicon-o-document-text')
                    ->modal()
                    ->modalHeading('Historial de Visitas')
                    ->modalContent(function ($record) {
                        $historial = OrdenesServicio::where('cliente_id', $record->id)
                            ->orderBy('fecha_creacion', 'desc')
                            ->get();

                        $renderedContent = Blade::render('
                            <div class="space-y-4">
                                @forelse($historial as $orden)
                                    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl border border-gray-200 dark:border-gray-700 p-4 hover:shadow-md transition-all">
                                        <div class="flex justify-between items-center mb-3 border-b border-gray-200 dark:border-gray-700 pb-2">
                                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Orden de Servicio</h3>
                                            <span class="text-sm text-gray-600 dark:text-gray-400">
                                                {{ $orden->fecha_creacion }}
                                            </span>
                                        </div>
                                        
                                        <div class="grid grid-cols-3 gap-4">
                                            <div class="flex flex-col items-start">
                                                <span class="text-sm text-gray-600 dark:text-gray-400 mb-1">Tipo de Servicio</span>
                                                <span class="text-base text-gray-800 dark:text-gray-200">
                                                    {{ $orden->tipo_servicio }}
                                                </span>
                                            </div>
                                            <div class="flex flex-col items-start">
                                                <span class="text-sm text-gray-600 dark:text-gray-400 mb-1">Estado</span>
                                                <span class="text-base text-gray-800 dark:text-gray-200">
                                                    {{ $orden->estado }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="flex justify-center items-center bg-gray-100 dark:bg-gray-800 rounded-xl p-6">
                                        <p class="text-gray-500 dark:text-gray-400 text-center">
                                            <x-heroicon-o-document-text class="w-12 h-12 mx-auto mb-3 text-gray-400 dark:text-gray-600"/>
                                            No hay historial de visitas
                                        </p>
                                    </div>
                                @endforelse
                            </div>
                        ', ['historial' => $historial]);

                        return new HtmlString($renderedContent);
                    })
            ])
            ->defaultSort('total_visitas', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClientesRecurrentes::route('/'),
        ];
    }
}
