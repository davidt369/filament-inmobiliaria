<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->required()
                    ->email()
                    ->maxLength(255)
                    ->unique(table: User::class, ignorable: fn (?User $record) => $record),
                TextInput::make('password')
                    ->required()
                    ->password()
                    ->maxLength(255)
                    ->hiddenOn('edit')
                    ->dehydrated(fn ($state) => !empty($state))
                    ->confirmed('password_confirmation')
                    ->label('Password')
                    ->autocomplete('new-password'),
                TextInput::make('password_confirmation')
                    ->password()
                    ->maxLength(255)
                    ->dehydrated(false)
                    ->hiddenOn('edit')
                    ->label('Confirm Password')
                    ->autocomplete('new-password'),
                Select::make('roles')->multiple()->relationship('roles', 'name')
                    ->preload()
                    ->label('Roles')
                    ->searchable()
                    ->required()

                    // ->afterStateUpdated(function (callable $set, $state) {
                    //     if (in_array('admin', $state)) {
                    //         $set('is_admin', true);
                    //     } else {
                    //         $set('is_admin', false);
                    //     }
                    // }),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->label('Name'),
                TextColumn::make('email')
                    ->sortable()
                    ->searchable()
                    ->label('Email'),
                TextColumn::make('created_at')
                    ->sortable()
                    ->searchable()
                    ->dateTime()
                    ->label('Created At'),
                TextColumn::make('roles.name')
                    ->sortable()
                    ->searchable()
                    ->label('Roles')
                    ->getStateUsing(function ($record) {
                        return $record->roles->pluck('name')->implode(', ');
                    }),
                TextColumn::make('email_verified_at')
                  ,
            ])
            ->filters([
                //
                Tables\Filters\Filter::make('verified')
                ->query(fn (Builder $query): Builder => $query->whereNotNull('email_verified_at'))
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Verify Email')
                    ->action(function (User $user) {
                        $user->email_verified_at = Date('Y-m-d H:i:s');
                        $user->save();
                    })

                    ->requiresConfirmation()
                    ->visible(fn ($record) => !$record->hasVerifiedEmail())
                    ->color('success')
                    ->icon('heroicon-o-check-badge'),
                Tables\Actions\Action::make('Unverify Email')
                    ->action(function (User $user) {
                        $user->email_verified_at = null;
                        $user->save();
                    })

                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->hasVerifiedEmail())
                    ->color('danger')
                    ->icon('heroicon-o-x-circle'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([

                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
