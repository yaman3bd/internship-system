<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Your Application') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-action-section>
                <x-slot name="title">
                    Application Information
                </x-slot>

                <x-slot name="description">
                    lamore ipsum dolor sit amet consectetur.
                    lamore ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptates.
                </x-slot>

                <x-slot name="content">
                    <h3 class="text-lg font-medium text-gray-900">
                        Application Type
                    </h3>

                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ \Illuminate\Support\Str::of($application->type)->replace('_',' ')->headline() }}
                        </p>
                    </div>
                    <div class="mt-5">
                        <h3 class="text-lg font-medium text-gray-900">
                            Submitted At
                        </h3>

                        <div class="mt-3 max-w-xl text-sm text-gray-600">
                            <p>
                                {{ $application->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-5">
                        <h3 class="text-lg font-medium text-gray-900">
                            Last Updated At
                        </h3>

                        <div class="mt-3 max-w-xl text-sm text-gray-600">
                            <p>
                                {{ $application->updated_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                    </div>
                </x-slot>
            </x-action-section>
            <x-section-border/>
            <x-action-section>
                <x-slot name="title">
                    Application Status
                </x-slot>

                <x-slot name="description">
                    lamore ipsum dolor sit amet consectetur.
                    lamore ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptates.
                </x-slot>

                <x-slot name="content">
                    <h3 class="text-lg font-medium text-gray-900">
                        Status
                    </h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            @if($application->status==='waiting_for_sgk')
                                <span
                                    class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded uppercase">Waiting For SGK</span>
                            @endif
                            @if($application->status==='pending')
                                <span
                                    class="bg-gray-100 text-gray-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded uppercase">Pending</span>
                            @endif
                            @if($application->status==='approved')
                                <span
                                    class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded uppercase">Approved</span>
                            @endif
                            @if($application->status==='rejected')
                                <span
                                    class="bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded uppercase">rejected</span>
                            @endif
                        </p>
                    </div>
                    <div class="mt-5">
                        <h3 class="text-lg font-medium text-gray-900">
                            Internship Coordinator Notes
                        </h3>

                        @if(strip_tags($application->message))
                            <div class="mt-3 max-w-xl prose">
                                {!! $application->message !!}
                            </div>
                        @else
                            <div class="mt-3 max-w-xl text-sm text-gray-600">
                                ----------------
                            </div>
                        @endif
                    </div>
                </x-slot>
            </x-action-section>
            <x-section-border/>
            <x-action-section>
                <x-slot name="title">
                    Application Files
                </x-slot>

                <x-slot name="description">
                    lamore ipsum dolor sit amet consectetur.
                    lamore ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptates.
                </x-slot>

                <x-slot name="content">
                    <h3 class="text-lg font-medium text-gray-900">
                        Click On File Name To Download
                    </h3>

                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            @foreach($files as $file)
                                <a href="{{$file['url']}}"
                                   download
                                   class="font-medium text-indigo-600 underline flex items-center gap-2">
                                    <span>{{ $file['name']}}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                    </svg>

                                </a>
                            @endforeach
                        </p>
                    </div>
                </x-slot>
            </x-action-section>
        </div>
    </div>
</x-app-layout>
