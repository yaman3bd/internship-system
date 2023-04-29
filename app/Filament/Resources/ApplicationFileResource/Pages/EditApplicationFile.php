<?php

namespace App\Filament\Resources\ApplicationFileResource\Pages;

use App\Filament\Resources\ApplicationFileResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditApplicationFile extends EditRecord
{
    protected static string $resource = ApplicationFileResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
