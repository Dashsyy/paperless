<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Arr;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Administration';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->email()
                    ->required(),
                Select::make('roles')->options(function () {
                    $roleNames = Role::query()
                        ->pluck('name');

                    $options = [];

                    foreach ($roleNames as $roleName) {
                        $options[$roleName] = $roleName;
                    }

                    return $options;
                }),
                TextInput::make('password')
                    ->password()
                    ->rules([
                        'nullable',
                        'sometimes',
                        'min:8',
                    ])
                    ->dehydrated(fn ($state) => filled($state)),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('roles')
                    ->getStateUsing(function (User $user) {
                        return $user->getRoleNames();
                    })
                    ->badge()
                    ->default('---')
                    ->color('gray'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make('edit')
                    ->requiresConfirmation()
                    ->mountUsing(function (Form $form, User $user) {
                        $form->fill(
                            collect($user->getAttributes())
                                ->merge(['roles' => $user->getRoleNames()])
                                ->toArray()
                        );
                    })
                    ->action(function (array $data, User $user) {
                        $user->update(Arr::except($data, 'roles'));
                        $user->syncRoles($data['roles']);
                    }),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
        ];
    }
}
