<?php

namespace App\Filament\Widgets;

use App\Models\OrdenesServicio;
use App\Models\Clientes;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1; // Este aparecerá primero

    protected function getStats(): array
    {
        // Órdenes activas por día (últimos 7 días)
        $ordenesData = OrdenesServicio::whereIn('estado', ['recibido', 'diagnostico', 'reparacion'])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('count', 'date')
            ->toArray();

        // Rellena días faltantes con 0 para las órdenes activas
        $ordenesChartData = [];
        foreach (range(-6, 0) as $days) {
            $date = now()->addDays($days)->toDateString();
            $ordenesChartData[] = $ordenesData[$date] ?? 0;
        }

        // Total de órdenes finalizadas por día (estado "entregado")
        $ordenesFinalizadasData = OrdenesServicio::where('estado', 'entregado')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('count', 'date')
            ->toArray();

        // Rellena días faltantes con 0 para las órdenes finalizadas
        $ordenesFinalizadasChartData = [];
        foreach (range(-6, 0) as $days) {
            $date = now()->addDays($days)->toDateString();
            $ordenesFinalizadasChartData[] = $ordenesFinalizadasData[$date] ?? 0;
        }

        // Total de clientes y registros por día (últimos 7 días)
        $clientesData = Clientes::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('count', 'date')
            ->toArray();

        // Rellena días faltantes con 0 para los clientes
        $clientesChartData = [];
        foreach (range(-6, 0) as $days) {
            $date = now()->addDays($days)->toDateString();
            $clientesChartData[] = $clientesData[$date] ?? 0;
        }

        // Total de clientes registrados
        $totalClientes = Clientes::count();

        return [
            Stat::make('Órdenes Activas', array_sum($ordenesChartData))
                ->description('Últimos 7 días')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart($ordenesChartData),

            Stat::make('Total de Clientes', $totalClientes)
                ->description('Últimos 7 días')
                ->descriptionIcon('heroicon-o-user-group')
                ->color('primary')
                ->chart($clientesChartData),

            Stat::make('Órdenes Finalizadas', array_sum($ordenesFinalizadasChartData))
                ->description('Últimos 7 días')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('warning')
                ->chart($ordenesFinalizadasChartData),
        ];
    }
}
