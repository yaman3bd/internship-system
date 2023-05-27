<?php

namespace App\Http\Controllers;

use App\Models\Message;


class AnnouncementController extends Controller
{
    public function index()
    {
        $messages = Message::query()->where('type', 'announcement')->get();

        return view('announcements.index', compact([
            'messages'
        ]));
    }

    public function show(Message $message)
    {
        return view('announcements.show', compact('message'));
    }
}
