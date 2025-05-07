<?php

namespace App\Filament\Resources\JobseekerResource\Pages;

use App\Filament\Resources\JobseekerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJobseeker extends EditRecord
{
    protected static string $resource = JobseekerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['seeker_name'] = $this->record->seeker->name ?? null;

        return $data;
    }
}
