<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <form class="max-w-lg mx-auto"
                  method="POST"
                  action="{{ route('applications.store') }}"
                  enctype="multipart/form-data"
            >
                @csrf
                <div class="mb-4">
                    <x-label for="file">
                        Application Type
                    </x-label>
                    <select
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
                       
                    </select>
                </div>
                <div class="mb-4">
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
                <div class="mt-8">
                    <x-button
                        type="submit"
                    >
                        Submit
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
