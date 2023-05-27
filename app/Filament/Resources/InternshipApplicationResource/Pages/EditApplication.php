<?php

namespace App\Filament\Resources\InternshipApplicationResource\Pages;

use App\Filament\Resources\InternshipApplicationResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Pages\Actions;
class EditApplication extends EditRecord
{
    protected static string $resource = InternshipApplicationResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
        ];
    }
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
                           ->success()
                           ->title('Application updated')
                           ->body('The application has been saved successfully.');
    }
}
