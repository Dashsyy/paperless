<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobSeekerResource\RelationManagers\JobSeekerRelationManager;
use App\Filament\Resources\SeekerResource\Pages;
use App\Filament\Resources\WorkHistoryResource\RelationManagers\WorkHistoryRelationManager;
use App\Models\Seeker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SeekerResource extends Resource
{
    protected static ?string $model = Seeker::class;

    protected static ?string $navigationIcon = 'heroicon-s-user-group';

    protected static ?string $navigationGroup = 'Job';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('phone')->string()->required(),
                TextInput::make('email')->email()->required(),
                TextInput::make('address')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')->label('#')
                    ->getStateUsing(fn ($record, $rowLoop): string => $rowLoop->iteration),
                TextColumn::make('name')->searchable()->copyable(),
                TextColumn::make('phone')->searchable()->copyable(),
                TextColumn::make('email')->searchable()->copyable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
            ]);
    }

    public static function getRelations(): array
    {
        return [
            JobSeekerRelationManager::class,
            WorkHistoryRelationManager::class,
        ];
    }

    public static function getDefaultSortColumn(): string
    {
        return 'created_at';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSeekers::route('/'),
            'create' => Pages\CreateSeeker::route('/create'),
            'edit' => Pages\EditSeeker::route('/{record}/edit'),
        ];
    }
}
