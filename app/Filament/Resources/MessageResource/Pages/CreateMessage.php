<?php

namespace App\Filament\Resources\MessageResource\Pages;

use App\Filament\Resources\MessageResource;
use App\Models\Admin;
use App\Models\Message;
use App\Models\User;
use App\Notifications\MessageNotification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Notification;


class CreateMessage extends CreateRecord
{
    protected static string $resource = MessageResource::class;
    protected static string $view = 'filament.forms.components.create-message';


    public $sendingMessage = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function sendMessage()
    {
        $this->emit('message-sending');
        $this->sendingMessage = true;

        $data = $this->form->getState();

        $body = $data['body'];
        $title = $data['title'];
        $user = User::findOrFail($data['user_id']);

        $message = new Message();
        $message->parent_id = null;
        $message->data = [
            'body' => $body,
            'title' => $title,
            'admin_id' => auth()->user()->id,
        ];

        $message->messageable_id = $user->id;
        $message->messageable_type = User::class;
        $message->save();

        Notification::send($user, new MessageNotification(['url' => route('messages.show', $message->id)]));

        $this->message = "";
        $this->sendingMessage = false;

        $this->getCreatedNotification()?->send();

        $this->redirect($this->getRedirectUrl());
    }

    protected function getCreatedNotification(): ?\Filament\Notifications\Notification
    {
        return \Filament\Notifications\Notification::make()
                           ->success()
                           ->title('Message sent')
                           ->body('The message has been sent successfully.');
    }
}
