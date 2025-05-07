<?php

namespace App\Filament\Resources\JobseekerResource\Pages;

use App\Filament\Resources\JobseekerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJobseekers extends ListRecords
{
    protected static string $resource = JobseekerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
