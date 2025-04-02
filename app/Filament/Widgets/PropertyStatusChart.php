<?php

namespace App\Filament\Widgets;

use App\Models\Property;
use Filament\Widgets\ChartWidget;

class PropertyStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Status the Properties';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = Property::query()
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$this->getStatusLabel($item->status) => [
                    'count' => $item->count,
                    'status' => $item->status
                ]];
            });
 
        return [
            'datasets' => [
                [
                    'label' => 'Status of Properties',
                    'data' => $data->pluck('count')->values(),
                    'backgroundColor' => $data->map(fn($item) => $this->getBackgroundColor($item['status']))->values(),
                    'borderColor' => $data->map(fn($item) => $this->getBorderColor($item['status']))->values(),
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $data->keys(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    private function getStatusLabel(string $status): string
    {
        return match ($status) {
            'available' => 'Disponible',
            'rented' => 'Rentada',
            'sold' => 'Vendida',
            'reserved' => 'Reservada',
            default => ucfirst($status),
        };
    }

    private function getBackgroundColor(string $status): string
    {
        return match ($status) {
            'available' => 'rgba(46, 204, 113, 0.2)',  // Verde para disponible
            'rented' => 'rgba(52, 152, 219, 0.2)',     // Azul para rentada
            'sold' => 'rgba(231, 76, 60, 0.2)',        // Rojo para vendida
            'reserved' => 'rgba(241, 196, 15, 0.2)',    // Amarillo para reservada
            default => 'rgba(149, 165, 166, 0.2)',      // Gris para otros estados
        };
    }

    private function getBorderColor(string $status): string
    {
        return match ($status) {
            'available' => 'rgba(46, 204, 113, 1)',
            'rented' => 'rgba(52, 152, 219, 1)',
            'sold' => 'rgba(231, 76, 60, 1)',
            'reserved' => 'rgba(241, 196, 15, 1)',
            default => 'rgba(149, 165, 166, 1)',
        };
    }
}


