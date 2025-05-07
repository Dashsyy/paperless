<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobseekerResource\Pages;
use App\Filament\Resources\JobseekerResource\RelationManagers;
use App\Models\Jobseeker;
use App\Models\SeekerRole;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JobseekerResource extends Resource
{
    protected static ?string $model = Jobseeker::class;

    protected static ?string $navigationIcon = 'heroicon-c-academic-cap';

    protected static ?string $navigationGroup = 'Job';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('seeker_name')
                    ->label('Seeker Name')
                    ->disabled(fn($operation) => $operation === 'edit')
                    ->dehydrated(),
                Select::make('role')
                ->options(SeekerRole::query()->pluck('name', 'id')),
                Textarea::make('description')->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('seeker.name'),
                TextColumn::make('role')->badge(),
                TextColumn::make('description')->limit(100)
            ])
            ->filters([
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobseekers::route('/'),
            'create' => Pages\CreateJobseeker::route('/create'),
            'edit' => Pages\EditJobseeker::route('/{record}/edit'),
        ];
    }
}
