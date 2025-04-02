<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyResource\Pages;
use App\Filament\Resources\PropertyResource\RelationManagers;
use App\Models\Property;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Estado de la Propiedad')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Estado')
                            ->options(['Disponible' => 'Disponible', 'Vendido' => 'Vendido', 'Alquilado' => 'Alquilado'])
                            ->required(),
                        Forms\Components\DatePicker::make('expiration_date')
                            ->label('Fecha de Expiración')
                            ->required(),
                        Forms\Components\Toggle::make('is_offer')
                            ->label('En oferta'),

                    ])->columns(2),

                Forms\Components\Section::make('Imágenes')
                    ->schema([
                        Forms\Components\FileUpload::make('image_urls')

                            ->label('Imágenes de la Propiedad')
                            ->image()
                            ->imageEditor()
                            ->multiple()
                            ->required(),

                        Forms\Components\FileUpload::make('seller_images')

                            ->label('Imágenes del Vendedor')
                            ->image()
                            ->multiple()
                            ->required(),

                    ])->columns(2),

                Forms\Components\Section::make('Referencias')
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->label('Categoría')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->label('Nombre'),
                                Forms\Components\TextInput::make('description')
                                    ->label('Descripción'),
                            ])
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('type_id')
                            ->relationship('type', 'name')
                            ->required()
                            ->label('Tipo')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->label('Nombre'),
                                Forms\Components\TextInput::make('description')
                                    ->label('Descripción'),
                            ])
                            ->searchable()
                            ->preload(),




                        Forms\Components\Select::make('owner_id')
                            ->relationship('owner', 'fullName')
                            ->required()
                            ->label('Propietario')
                            ->createOptionForm([
                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('fullName')
                                            ->required()
                                            ->label('Nombre Completo'),
                                        Forms\Components\TextInput::make('phone')
                                            ->label('Teléfono'),
                                        Forms\Components\TextInput::make('identityCard')
                                            ->label('Cédula de Identidad'),
                                        Forms\Components\TextInput::make('address')
                                            ->label('Dirección'),
                                        Forms\Components\TextInput::make('relativePhone')
                                            ->label('Teléfono del Familiar'),
                                        Forms\Components\TextInput::make('relativeName')
                                            ->label('Nombre del Familiar'),
                                        Forms\Components\TextInput::make('origin')
                                            ->label('Origen'),
                                        Forms\Components\TextInput::make('consignor')
                                            ->label('Consignatario'),
                                    ])
                            ])
                            ->searchable()
                            ->preload()



                    ])->columns(3),

                Forms\Components\Section::make('Precios')
                    ->schema([
                        Forms\Components\TextInput::make('price.description')
                            ->label('Descripción del Precio')
                            ->required(),

                        Forms\Components\TextInput::make('price.exchangeRate')
                            ->numeric()
                            ->label('Tipo de Cambio')
                            ->required(),

                        Forms\Components\TextInput::make('price.priceOwnerUSD')
                            ->numeric()
                            ->label('Precio Propietario USD')
                            ->required(),

                        Forms\Components\TextInput::make('price.priceOwnerBs')
                            ->numeric()
                            ->label('Precio Propietario Bs')
                            ->required(),

                        Forms\Components\TextInput::make('price.priceUSD')
                            ->numeric()
                            ->label('Precio USD')
                            ->required(),

                        Forms\Components\TextInput::make('price.priceBs')
                            ->numeric()
                            ->label('Precio Bs')
                            ->required(),

                        Forms\Components\TextInput::make('price.pricePerSquareMeterBs')
                            ->numeric()
                            ->label('Precio por Metro Cuadrado Bs')
                            ->required(),
                    ])
                    ->columns(2),





                Forms\Components\Section::make('Ubicación')
                    ->schema([
                        Forms\Components\TextInput::make('location.address')
                            ->label('Dirección')
                            ->required(),
                        Forms\Components\TextInput::make('location.locationUrl')
                            ->label('URL Ubicación')
                            ->required(),
                        Forms\Components\TextInput::make('location.zone')
                            ->label('Zona')
                            ->required(),
                        Forms\Components\TextInput::make('location.seller_location')
                            ->label('Ubicación del Vendedor')
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Características')
                    ->schema([
                        Forms\Components\TextInput::make('feature.floors')
                            ->numeric()
                            ->label('Número de Pisos')
                            ->required(),
                        Forms\Components\TextInput::make('feature.surfaceArea')
                            ->numeric()
                            ->label('Superficie m²')
                            ->required(),
                        Forms\Components\TextInput::make('feature.builtArea')
                            ->numeric()
                            ->label('Superficie Construida m²')
                            ->required(),
                        Forms\Components\TextInput::make('feature.front')
                            ->numeric()
                            ->label('Frente')
                            ->required(),
                        Forms\Components\RichEditor::make('feature.details')
                            ->label('Detalles')
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Servicios')
                    ->schema([
                        Forms\Components\Select::make('services')
                            ->multiple()
                            ->relationship('services', 'name')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->label('Nombre del Servicio'),
                                Forms\Components\TextInput::make('description')
                                    ->label('Descripción'),
                            ])
                            ->searchable()
                            ->preload()
                            ->label('Servicios Disponibles'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('status')
                    ->label('Estado')
                    ->sortable(),
                Tables\Columns\TextColumn::make('owner.fullName')
                    ->label('Propietario')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Categoría')
                    ->sortable(),
                Tables\Columns\TextColumn::make('type.name')
                    ->label('Tipo')
                    ->sortable(),
                Tables\Columns\TextColumn::make('price.priceBs')
                    ->label('Precio BS')
                    ->money('BOB')
                    ->sortable(),
                Tables\Columns\TextColumn::make('price.priceUSD')
                    ->label('Precio USD')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('location.address')
                    ->label('Dirección')
                    ->limit(30)
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_offer')
                    ->label('En Oferta')
                    ->boolean(),
                Tables\Columns\TextColumn::make('expiration_date')
                    ->label('Fecha de Expiración')
                    ->dateTime()
                    ->sortable(),

            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\OwnerRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
