<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Announcement') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-action-section>
                <x-slot name="title">
                    Announcement Information
                </x-slot>

                <x-slot name="description">
                    lamore ipsum dolor sit amet consectetur.
                    lamore ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptates.
                </x-slot>

                <x-slot name="content">
                    <h3 class="text-lg font-medium text-gray-900">
                        Subject
                    </h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $message->data['title'] }}
                        </p>
                    </div>
                    <div class="mt-5">
                        <h3 class="text-lg font-medium text-gray-900">
                            Sent At
                        </h3>

                        <div class="mt-3 max-w-xl text-sm text-gray-600">
                            <p>
                                {{ $message->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                    </div>
                </x-slot>
            </x-action-section>
            <x-section-border/>
            <x-action-section>
                <x-slot name="title">
                    {{$message->messageable->name}}
                </x-slot>

                <x-slot name="description">
                    {{$message->messageable->email}}
                </x-slot>

                <x-slot name="content">

                    <div class="text-lg font-medium text-gray-900 max-w-xl">
                        <p>
                            {{$message->data['body']}}
                        </p>
                    </div>
                </x-slot>
            </x-action-section>
        </div>
    </div>
</x-app-layout>
