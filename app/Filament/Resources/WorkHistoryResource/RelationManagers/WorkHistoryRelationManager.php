<?php

namespace App\Filament\Resources\WorkHistoryResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WorkHistoryRelationManager extends RelationManager
{
    protected static string $relationship = 'WorkHistory';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('seeker_id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('seeker_id')
            ->columns([
                Tables\Columns\TextColumn::make('start_date')
                    ->date(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date(),
                Tables\Columns\TextColumn::make('Duration')
                    ->default('N/A')
                    ->formatStateUsing(function ($record) {
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
                Tables\Columns\TextColumn::make('company_name')->badge(),
                Tables\Columns\TextColumn::make('position'),
                Tables\Columns\TextColumn::make('description')
                ->limit(255)
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
            ]);
    }
}
