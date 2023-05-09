<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Submit New Application') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-action-section>
                <x-slot name="title">
                    Submit New Application
                </x-slot>

                <x-slot name="description">
                    lamore ipsum dolor sit amet consectetur.
                    lamore ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptates.
                </x-slot>

                <x-slot name="content">
                    <h3 class="text-lg font-medium text-gray-900">
                        Submit New Application
                    </h3>

                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            lamore ipsum dolor sit amet consectetur.
                            lamore ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptates.
                        </p>
                    </div>
                    <form method="POST"
                          action="{{ route('applications.store') }}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4 mt-5">
                            <x-label for="file">
                                Application Type
                            </x-label>
                            <select
                                required
                                id="application_type"
                                name="application_name"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                            >
                                <option
                                    selected
                                    disabled
                                    value="">
                                    Select an application type
                                </option>
                                <option
                                    value="official_letter_request">
                                    Official Letter Request
                                </option>
                                <option
                                    value="internship_application">
                                    Internship Application
                                </option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <x-label for="file">
                                File Upload Field
                            </x-label>
                            <x-input
                                accepts="application/pdf"
                                id="file"
                                name="meta[files][]"
                                multiple
                                type="file"/>
                        </div>
                        <div class="mt-5">
                            <x-button type="submit">
                                {{ __('Submit') }}
                            </x-button>
                            <a class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                               href="{{ route('applications.index') }}"
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
