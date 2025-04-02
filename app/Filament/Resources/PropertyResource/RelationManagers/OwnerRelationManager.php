<?php

namespace App\Filament\Resources\PropertyResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Support\Enums\FontWeight;

class OwnerRelationManager extends RelationManager
{
    protected static string $relationship = 'Owner';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('fullName')
                    ->required()
                    ->maxLength(255)
                    ->label('Nombre Completo'),
                Forms\Components\TextInput::make('phone')
                    ->required()
                    ->tel()
                    ->maxLength(20)
                    ->label('Teléfono'),
                Forms\Components\TextInput::make('identityCard')
                    ->required()
                    ->maxLength(20)
                    ->label('Documento de Identidad'),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(255)
                    ->label('Dirección'),
                Forms\Components\TextInput::make('relativePhone')
                    ->tel()
                    ->maxLength(20)
                    ->label('Teléfono de Familiar'),
                Forms\Components\TextInput::make('relativeName')
                    ->maxLength(255)
                    ->label('Nombre del Familiar'),
                Forms\Components\TextInput::make('origin')
                    ->maxLength(255)
                    ->label('Origen'),
                Forms\Components\TextInput::make('consignor')
                    ->maxLength(255)
                    ->label('Consignador'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fullName')
                    ->weight(FontWeight::Bold)
                    ->searchable()
                    ->sortable()
                    ->label('Nombre Completo'),
                Tables\Columns\TextColumn::make('phone')
                    ->icon('heroicon-m-phone')
                    ->searchable()
                    ->label('Teléfono'),
                Tables\Columns\TextColumn::make('identityCard')
                    ->icon('heroicon-m-identification')
                    ->searchable()
                    ->label('Documento'),
                Tables\Columns\TextColumn::make('address')
                    ->icon('heroicon-m-map-pin')
                    ->searchable()
                    ->label('Dirección'),
                Tables\Columns\TextColumn::make('relativePhone')
                    ->icon('heroicon-m-phone')
                    ->label('Tel. Familiar'),
                Tables\Columns\TextColumn::make('relativeName')
                    ->icon('heroicon-m-user')
                    ->label('Nombre Familiar'),
                Tables\Columns\TextColumn::make('origin')
                    ->icon('heroicon-m-globe-alt')
                    ->label('Origen'),
                Tables\Columns\TextColumn::make('consignor')
                    ->icon('heroicon-m-user-group')
                    ->label('Consignador'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
