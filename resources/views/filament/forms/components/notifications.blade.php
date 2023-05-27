@php

    $user = auth()->user();
    $message = $user->messages()->with('replies')->find(1);
    if ($user->hasRole('super-admin')) {
       $message=\App\Models\Message::query()->with('replies')->find($record->id);
    }else{
       $message = $user->messages()->with('replies')->find($record->id);
    }
    $message=\App\Models\Message::query()->with('replies')->find($record->id);

@endphp
<div
    class="grid grid-cols-1 lg:grid-cols-2 filament-forms-component-container gap-6"
>
    <div class="col-span-1">
        <div id="data.student-information"
             class="filament-forms-section-component rounded-xl border border-gray-300 bg-white dark:border-gray-600 dark:bg-gray-800">
            <div
                class="filament-forms-section-header-wrapper flex rtl:space-x-reverse overflow-hidden rounded-t-xl min-h-[56px] px-4 py-2 items-center bg-gray-100 dark:bg-gray-900">
                <div class="filament-forms-section-header flex-1 space-y-1">
                    <h3 class="font-bold tracking-tight pointer-events-none flex flex-row items-center text-xl">
                        {{$message->data['title']}}
                    </h3>
                </div>
            </div>
            <div class="filament-forms-section-content-wrapper">
                <div class="filament-forms-section-content p-6">
                    <div class="flex flex-col gap-6">
                        <fieldset
                            class="filament-forms-fieldset-component rounded-xl shadow-sm border border-gray-300 p-6 dark:border-gray-600 dark:text-gray-200">
                            <legend class="text-sm leading-tight font-medium px-2 -ml-2">
                                {{$message->messageable->name}}
                            </legend>
                            <div class="col-span-full">
                                <div class="filament-forms-field-wrapper">
                                    <div class="space-y-2">
                                        <p id="data.message.{{$message->id}}"
                                           style="height: 150px">
                                            {{$message->data['body']}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        @foreach ($message->replies as $reply)
                            <fieldset
                                class="filament-forms-fieldset-component rounded-xl shadow-sm border border-gray-300 p-6 dark:border-gray-600 dark:text-gray-200">
                                <legend class="text-sm leading-tight font-medium px-2 -ml-2">
                                    {{$reply->messageable->name}}
                                </legend>
                                <div class="col-span-full">
                                    <div class="filament-forms-field-wrapper">
                                        <div class="space-y-2">
                                            <p id="data.message.{{$reply->id}}"
                                               style="height: 150px">
                                                {{$reply->data['body']}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div
        class="col-span-1"
    >
        <div id="data.student-information"
             style="position: sticky;top: 100px;"
             class="filament-forms-section-component rounded-xl border border-gray-300 bg-white dark:border-gray-600 dark:bg-gray-800">
            <div
                class="filament-forms-section-header-wrapper flex rtl:space-x-reverse overflow-hidden rounded-t-xl min-h-[56px] px-4 py-2 items-center bg-gray-100 dark:bg-gray-900">
                <div class="filament-forms-section-header flex-1 space-y-1">
                    <h3 class="font-bold tracking-tight pointer-events-none flex flex-row items-center text-xl">
                        Leave Reply
                    </h3>
                </div>
            </div>
            <div class="filament-forms-section-content-wrapper">
                <div class="filament-forms-section-content p-6">
                    <div class="flex flex-col gap-6">
                        <div class="col-span-full">
                            <div class="filament-forms-field-wrapper">
                                <div class="space-y-2">
                                    <div class="flex items-center justify-between space-x-2 rtl:space-x-reverse">
                                        <label
                                            class="filament-forms-field-wrapper-label inline-flex items-center space-x-3 rtl:space-x-reverse"
                                            for="data.message">
                                            <span
                                                class="text-sm font-medium leading-4 text-gray-700 dark:text-gray-300">
                                                Message Body
                                            </span>
                                        </label>
                                        <div
                                            class="filament-forms-field-wrapper-hint flex items-center space-x-2 rtl:space-x-reverse text-gray-500 dark:text-gray-300">
                                            <span
                                                class="text-xs leading-tight"><p>Leave a message to the student</p></span>
                                        </div>
                                    </div>
                                    <form
                                        wire:submit.prevent="sendMessage"
                                    >
                                <textarea id="data.message"
                                            wire:model.defer="message"
                                          placeholder="Enter a message to the student"
                                          class="filament-forms-textarea-component block w-full transition duration-75 rounded-lg shadow-sm outline-none focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 disabled:opacity-70 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-primary-500 border-gray-300"
                                          style="height: 150px"></textarea>
                                        <button
                                            type="submit"
                                            class="filament-forms-button filament-forms-button-primary inline-flex items-center space-x-2">
                                            <span>Send</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

