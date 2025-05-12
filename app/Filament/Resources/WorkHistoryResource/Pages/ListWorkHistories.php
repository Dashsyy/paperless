<?php

namespace App\Filament\Resources\WorkHistoryResource\Pages;

use App\Filament\Resources\WorkHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWorkHistories extends ListRecords
{
    protected static string $resource = WorkHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
