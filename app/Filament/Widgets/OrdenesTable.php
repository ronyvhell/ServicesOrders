<?php

namespace App\Filament\Widgets;

use App\Models\OrdenesServicio;
use App\Models\Clientes;
use App\Models\Vehiculos;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class OrdenesTable extends ChartWidget
{
    protected static ?int $sort = 2; // Este aparecerá primero

    protected static ?string $heading = 'Registros Mensuales';

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        // Consultar la cantidad de órdenes creadas por mes en el año actual
        $ordenesMensuales = OrdenesServicio::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Consultar la cantidad de clientes creados por mes en el año actual
        $clientesMensuales = Clientes::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Consultar la cantidad de vehículos creados por mes en el año actual
        $vehiculosMensuales = Vehiculos::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Rellenar los meses faltantes con 0 para asegurar que haya un valor para cada mes del año
        $ordenesData = [];
        $clientesData = [];
        $vehiculosData = [];
        
        for ($month = 1; $month <= 12; $month++) {
            $ordenesData[] = $ordenesMensuales[$month] ?? 0;
            $clientesData[] = $clientesMensuales[$month] ?? 0;
            $vehiculosData[] = $vehiculosMensuales[$month] ?? 0;
        }

        return [
            'labels' => [
                'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
            ],
            'datasets' => [
                [
                    'label' => 'Órdenes Creadas',
                    'data' => $ordenesData,
                    'borderColor' => '#2196F3',
                    'backgroundColor' => 'rgba(33, 150, 243, 0.2)',
                    'fill' => true,
                ],
                [
                    'label' => 'Clientes Creados',
                    'data' => $clientesData,
                    'borderColor' => '#4CAF50',
                    'backgroundColor' => 'rgba(76, 175, 80, 0.2)',
                    'fill' => true,
                ],
                [
                    'label' => 'Vehículos Creados',
                    'data' => $vehiculosData,
                    'borderColor' => '#FF9800',
                    'backgroundColor' => 'rgba(255, 152, 0, 0.2)',
                    'fill' => true,
                ],
            ],
        ];
    }
}
