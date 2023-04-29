<?php

namespace App\Filament\Resources\ApplicationFileResource\Pages;

use App\Filament\Resources\ApplicationFileResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApplicationFiles extends ListRecords
{
    protected static string $resource = ApplicationFileResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
