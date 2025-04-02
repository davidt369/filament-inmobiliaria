<?php

namespace App\Filament\Widgets;

use App\Models\Property;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class PropertyChart extends ChartWidget
{
    protected static ?string $heading = 'Properties Created in the Last 6 Months';
    protected static ?int $sort = 3; // Número alto para asegurar que aparezca al final

    protected function getData(): array
    {
        $propertiesData = $this->getPropertiesPerMonth();
        
        return [
            'datasets' => [
                [
                    'label' => 'Properties Created',
                    'data' => array_values($propertiesData),
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => array_keys($propertiesData),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
    
    private function getPropertiesPerMonth(): array
    {
        $now = Carbon::now();
        $sixMonthsAgo = $now->copy()->subMonths(5);
        
        $properties = Property::query()
            ->whereBetween('created_at', [$sixMonthsAgo->startOfMonth(), $now->endOfMonth()])
            ->get();

        $propertiesPerMonth = [];
        
        for ($i = 0; $i < 6; $i++) {
            $month = $sixMonthsAgo->copy()->addMonths($i);
            $monthKey = $month->format('F');
            
            $propertiesPerMonth[$monthKey] = $properties
                ->filter(function ($property) use ($month) {
                    return $property->created_at->format('Y-m') === $month->format('Y-m');
                })
                ->count();
        }

        return $propertiesPerMonth;
    }
}
