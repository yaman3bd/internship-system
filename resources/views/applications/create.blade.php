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
                            please select the type of application you would like to submit.
                        </p>
                    </div>
                    <form method="POST"
                          action="{{ route('applications.store') }}"
                          enctype="multipart/form-data"
                          x-data="{ appType:  '' }"
                    >
                        @csrf
                        <div class="mb-4 mt-5">
                            <x-label for="file">
                                Application Type
                            </x-label>
                            <select
                                x-model="appType"
                                required
                                id="type"
                                name="type"
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
                        <div class="mt-4" x-show="appType==='internship_application'">
                            <x-label for="file">
                                File Upload Field
                            </x-label>
                            <x-input
                                accepts="application/pdf"
                                id="file"
                                name="meta[files][]"
                                multiple
                                required="appType==='internship_application'"
                                type="file"/>
                        </div>
                        <template
                            x-if="appType==='official_letter_request'"
                        >
                            <div class="mt-4 space-y-4">
                                <div>
                                    <x-label for="company_name">
                                        {{ __('Company Name') }}
                                        <span class="text-red-500">*</span>
                                    </x-label>
                                    <x-input
                                        required="appType==='official_letter_request'"
                                        id="company_name" name="company_name" type="text" class="mt-1 block w-full"/>
                                    <x-input-error for="company_name" class="mt-2"/>
                                </div>
                                <div>
                                    <x-label for="name_of_the_department_internship_coordinator"
                                    >
                                        {{ __('Name Of The Department Internship Coordinator') }}
                                        <span class="text-red-500">*</span>
                                    </x-label>
                                    <x-input
                                        required="appType==='official_letter_request'"
                                        id="name_of_the_department_internship_coordinator"
                                        name="name_of_the_department_internship_coordinator" type="text"
                                        class="mt-1 block w-full"/>
                                    <x-input-error for="name_of_the_department_internship_coordinator" class="mt-2"/>
                                </div>
                                <div>
                                    <x-label
                                        for="number_of_incomplete_internships"
                                    >
                                        {{ __('Number Of Incomplete Internships') }}
                                        <span class="text-red-500">*</span>
                                    </x-label>
                                    <x-input
                                        required="appType==='official_letter_request'"
                                        id="number_of_incomplete_internships" name="number_of_incomplete_internships"
                                        type="number" class="mt-1 block w-full"/>
                                    <x-input-error for="number_of_incomplete_internships" class="mt-2"/>
                                </div>
                            </div>
                        </template>
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
