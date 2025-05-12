<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkHistoryResource\Pages;
use App\Filament\Resources\WorkHistoryResource\RelationManagers;
use App\Filament\Resources\WorkHistoryResource\RelationManagers\WorkHistoryRelationManager;
use App\Models\WorkHistory;
use Filament\Forms;
use Filament\Forms\Components\Builder;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;

class WorkHistoryResource extends Resource
{
    protected static ?string $model = WorkHistory::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static ?string $navigationGroup = 'Job';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('company_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('position')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('start_date')
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->rows(3)
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company_name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('position')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date'),
                Tables\Columns\TextColumn::make('end_date'),
                Tables\Columns\TextColumn::make('total_duration')
                    ->label('Total Duration')
                    ->default('N/A')
                    ->formatStateUsing(function ($record) {
                        if (!$record->start_date || !$record->end_date) {
                            return 'N/A';
                        }

                        $start = \Carbon\Carbon::parse($record->start_date);
                        $end = \Carbon\Carbon::parse($record->end_date);
                        $totalMonth = intval( $start->diffInMonths($end));
                        $year = intval($totalMonth / 12);
                        $month = $totalMonth % 12;

                        $display = 'N/A';

                        if(empty($month)){
                            $display = $year.' year'. ($year > 1 ? 's' : '');
                        }
                        else{
                            $display = $year.' year'. ($year > 1 ? 's' : '') . ' ' . $month.' month'. ($month > 1 ? 's' : '');
                        }

                        return $display;
                    }),


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
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorkHistories::route('/'),
            'create' => Pages\CreateWorkHistory::route('/create'),
            'edit' => Pages\EditWorkHistory::route('/{record}/edit'),
        ];
    }
}
