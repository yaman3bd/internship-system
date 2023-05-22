<div>
    @php
        $user = auth()->user();
        $message = $user->messages()->with('replies')->find(1);
        if ($user->hasRole('super-admin')) {
           $message=\App\Models\Message::query()->with('replies')->find($getRecord()->id);
        }else{
           $message = $user->messages()->with('replies')->find($getRecord()->id);
        }
        $message=\App\Models\Message::query()->with('replies')->find($getRecord()->id);

    @endphp
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
