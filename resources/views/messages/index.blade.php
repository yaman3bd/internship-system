<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Messages') }}
        </h2>
    </x-slot>
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="pb-4 flex justify-end">
                <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                   href="{{ route('messages.create') }}">Send New Message</a>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-left">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-lg font-medium text-gray-900">
                           Sender Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-lg font-medium text-gray-900">
                           Subject
                        </th>
                        <th scope="col" class="px-6 py-3 text-lg font-medium text-gray-900">
                            Sent At
                        </th>
                        <th scope="col" class="px-6 py-3 text-lg font-medium text-gray-900">
                            #
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($messages as $message)
                        <tr @class(['border-b hover:bg-gray-50',$loop->last?'':'border-b',
$message->read_at?'bg-white  hover:bg-gray-50':'bg-gray-200 hover:bg-gray-300',
])>
                            <td class="px-6 py-4 text-base text-gray-600">
                                {{ $message->messageable->name }}
                            </td>
                            <td class="px-6 py-4">

                                {{ $message->data['title'] }}
                            </td>
                            <td class="px-6 py-4 text-base text-gray-600">
                                {{ $message->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{route('messages.show',$message->id)}}"
                                   class="font-medium text-indigo-600 underline">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-base text-gray-600">
                                No messages found.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
