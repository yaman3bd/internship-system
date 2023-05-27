@php
    $type=request()->query('type');

@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Send New Message') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-action-section>
                <x-slot name="title">
                    New Message
                </x-slot>

                <x-slot name="description">
                    lamore ipsum dolor sit amet consectetur.
                    lamore ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptates.
                </x-slot>

                <x-slot name="content">
                    <h3 class="text-lg font-medium text-gray-900">
                       Send new message
                    </h3>

                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            please select the contact you would like to send a message to.
                        </p>
                    </div>
                    <form method="POST"
                          action="{{ route('messages.store') }}"
                    >
                        @csrf
                        <div
                            class="space-y-4 mt-4"
                        >
                            <div>
                                <x-label for="admin_id">
                                    Contacts
                                    <span class="text-red-500">*</span>
                                </x-label>
                                <select
                                    required
                                    id="admin_id"
                                    name="admin_id"
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                >
                                    <option
                                        selected
                                        disabled
                                        value="">
                                        Select Contact
                                    </option>
                                    @foreach($admins as $admin)
                                        <option
                                            value="{{ $admin->id }}"
                                        >
                                            {{ $admin->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-label for="title"
                                >
                                    Subject
                                    <span class="text-red-500">*</span>
                                </x-label>
                                <x-input
                                    required
                                    id="title"
                                    name="title" type="text"
                                    class="mt-1 block w-full"/>
                                <x-input-error for="subject" class="mt-2"/>
                            </div>
                            <div>
                                <x-label for="body">
                                    Message Body
                                    <span class="text-red-500">*</span>
                                </x-label>
                                <textarea
                                    id="body"
                                    name="body"
                                    rows="6"
                                    class=" mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                                ></textarea>
                            </div>
                        </div>
                        <div class="mt-5">
                            <x-button type="submit">
                                {{ __('Send') }}
                            </x-button>
                            <a class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                               href="{{ route('messages.index') }}"
                            >
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                </x-slot>
            </x-action-section>
        </div>
    </div>
</x-app-layout>
