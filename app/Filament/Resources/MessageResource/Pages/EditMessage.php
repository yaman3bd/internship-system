<?php

namespace App\Filament\Resources\MessageResource\Pages;

use App\Filament\Resources\MessageResource;
use App\Models\Admin;
use App\Models\Message;
use App\Notifications\MessageNotification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Notification;


class EditMessage extends EditRecord
{
    protected static string $resource = MessageResource::class;
    protected static string $view = 'filament.forms.components.notifications';
    public $message = "";

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }


    public function sendMessage()
    {
        if ( ! $this->message) {
            return;
        }
        $parent_id = $this->record->id;

        $parent_message = Message::query()->find($parent_id);


        $message = new Message();
        $message->parent_id = $parent_id;
        $message->data = [
            'body' => $this->message,
            'title' => $parent_message->data['title'],
            'admin_id' => $parent_message->data['admin_id'],
        ];

        $message->messageable_id = auth()->user()->id;
        $message->messageable_type = Admin::class;
        $message->save();

        Notification::send($parent_message->messageable,
            new MessageNotification(['url' => route('messages.show', $message->id)]));

        $this->message = "";
        $this->getSavedNotification()?->send();

        if (($redirectUrl = $this->getRedirectUrl())) {
            $this->redirect($redirectUrl);
        }
    }

    protected function getSavedNotification(): ?\Filament\Notifications\Notification
    {
        return \Filament\Notifications\Notification::make()
                                                   ->success()
                                                   ->title('Message sent')
                                                   ->body('Message sent successfully.');
    }
}
