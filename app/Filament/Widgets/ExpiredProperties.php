<?php

namespace App\Filament\Widgets;

use App\Models\Property;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ExpiredProperties extends BaseWidget
{
    protected static ?int $sort = 4;
    
    // Hacer que el widget ocupe todo el ancho
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Property::query()
                    ->with(['type', 'owner'])
            )
            ->columns([
                Tables\Columns\TextColumn::make('type.name')
                    ->label('Tipo de Propiedad')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('owner.fullName')
                    ->label('Nombre del Dueño')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('owner.phone')
                    ->label('Teléfono')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('expiration_date')
                    ->label('Fecha de Expiración')
                    ->sortable()
                    ->searchable()
                    ->dateTime(),
            ]);
    }
}
