<?php

namespace App\Filament\Widgets;

use App\Models\OrdenesServicio;
use Filament\Widgets\ChartWidget;

class OrdenesDoughnut extends ChartWidget
{
    protected static ?int $sort = 2; // Este aparecerá primero

    protected static ?string $heading = 'Órdenes por Estado';

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getData(): array
    {
        $estados = [
            'recibido' => 'Recibido',
            'diagnostico' => 'En Diagnóstico',
            'aprobacion' => 'Esperando Aprobación',
            'reparacion' => 'En Reparación',
            'entrega' => 'Listo para Entrega',
            'entregado' => 'Entregado',
            'cancelado' => 'Cancelado',
        ];

        $data = OrdenesServicio::selectRaw('estado, COUNT(*) as total')
            ->groupBy('estado')
            ->pluck('total', 'estado')
            ->toArray();

        $chartData = [
            'labels' => array_values($estados),
            'datasets' => [
                [
                    'data' => array_map(fn($estado) => $data[$estado] ?? 0, array_keys($estados)),
                    'backgroundColor' => [
                        '#4CAF50', '#FFC107', '#F44336', '#2196F3', '#FF9800', '#8BC34A', '#9E9E9E'
                    ]
                ],
            ],
        ];

        return $chartData;
    }

    protected function getOptions(): array
    {
        return [
            'maintainAspectRatio' => false, // Para que se ajuste al tamaño del contenedor
            'responsive' => true,
            'plugins' => [
                'legend' => [
                    'position' => 'bottom', // Posición de la leyenda
                ],
            ],
        ];
    }
}
