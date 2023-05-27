<?php

namespace App\Filament\Resources\AnnouncementResource\Pages;

use App\Filament\Resources\AnnouncementResource;
use App\Models\Admin;
use App\Models\Message;
use App\Models\User;
use App\Notifications\AnnouncementNotification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Notification;

class CreateAnnouncement extends CreateRecord
{
    protected static string $resource = AnnouncementResource::class;
    protected static string $view = 'filament.forms.components.create-announcement';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function sendMessage()
    {

        $data = $this->form->getState();

        $body = Arr::get($data, 'data.body');
        $title = Arr::get($data, 'data.title');


        $message = new Message();
        $message->parent_id = null;
        $message->type = "announcement";
        $message->data = [
            'body' => $body,
            'title' => $title,
        ];

        $message->messageable_id = auth()->user()->id;
        $message->messageable_type = Admin::class;
        $message->save();

        User::query()->each(function ($user) use ($message) {
            Notification::send($user, new AnnouncementNotification(
                [
                    'url' => route('announcements.show', $message->id),
                ]
            ));
        });

        $this->getCreatedNotification()?->send();

        $this->redirect($this->getRedirectUrl());
    }

    protected function getCreatedNotification(): ?\Filament\Notifications\Notification
    {
        return \Filament\Notifications\Notification::make()
                                                   ->success()
                                                   ->title('Announcement sent')
                                                   ->body('The announcement has been sent to all students successfully.');
    }
}
