<?php

namespace App\Filament\Widgets;

use App\Models\Property;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            //
            Stat::make('Total Properties', Property::count())
                ->icon('heroicon-o-home')
                ->description('Total number of properties')
                ->color('success')
                ->chart([6,4,9,5,3,0,7,8,4,]),
            
            Stat::make('Total Owners', \App\Models\Owner::count())
                ->icon('heroicon-o-users')
                ->description('Total number of owners')
                ->color('info')
                ->chart([2,3,5,7,8,4,6,9,2,]),
            
            Stat::make('Total Clients', \App\Models\Client::count())
                ->icon('heroicon-o-user-group')
                ->description('Total number of clients')
                ->color('warning')
                ->chart([1,2,3,4,5,6,7,8,9,]),
            
          
        ];
    }
}
