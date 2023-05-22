<?php

namespace App\Filament\Resources\MessageResource\Pages;

use App\Filament\Resources\MessageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Pages\Actions\Action;
use App\Models\User;
use Filament\Forms;

class EditMessage extends EditRecord
{
    protected static string $resource = MessageResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Action::make('updateAuthor')
                  ->action(function (array $data): void {
                      $this->record->author()->associate($data['authorId']);
                      $this->record->save();
                  })
                  ->form([
                      Forms\Components\Select::make('authorId')
                                             ->label('Author')
                                             ->options(User::query()->pluck('name', 'id'))
                                             ->required(),
                  ]),
        ];
    }
}
