<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Message;
use App\Models\User;
use App\Notifications\MessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;


class MessageController extends Controller
{
    public function index()
    {
        $messages = auth()->user()->messages()->where('parent_id', null)->get();

        return view('messages.index', compact([
            'messages'
        ]));
    }

    public function show(Message $message)
    {
        $message = $message->load('replies');

        return view('messages.show', compact('message'));
    }

    public function create()
    {
        $admins = Admin::query()->get();

        return view('messages.create', compact('admins'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'admin_id' => 'required',
            'title' => 'required',
            'body' => 'required',
        ]);

        $admin = Admin::query()->findOrFail($validated['admin_id']);
        $message = new Message();
        $message->parent_id = null;
        $message->data = [
            'body' => $validated['body'],
            'title' => $validated['title'],
        ];

        $message->messageable_id = auth()->user()->id;
        $message->messageable_type = User::class;
        $message->save();

        Notification::send($admin, new MessageNotification());

        session()->flash('flash.banner', 'Message Sent Successfully!');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('messages.index');
    }

    public function reply(Request $request, Message $message)
    {

        $validated = $request->validate([
            'body' => 'required',
        ]);

        $new_message = new Message();
        $new_message->parent_id = $message->id;
        $new_message->data = [
            'body' => $validated['body'],
            'title' => $message->data['title'],
        ];

        $new_message->messageable_id = auth()->user()->id;
        $new_message->messageable_type = User::class;
        $new_message->save();

        Notification::send($message->messageable, new MessageNotification());

        session()->flash('flash.banner', 'Message Sent Successfully!');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('messages.index');
    }
}
