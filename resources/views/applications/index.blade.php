<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Applications') }}
        </h2>
    </x-slot>
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="pb-4 flex justify-end">
                <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                   href="{{ route('applications.create',[
		                     'type' => request()->query('type')??'official_letter_request'
]) }}">Submit New Application</a>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-left">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-lg font-medium text-gray-900">
                            Application Type
                        </th>
                        <th scope="col" class="px-6 py-3 text-lg font-medium text-gray-900">
                            Application Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-lg font-medium text-gray-900">
                            Submitted At
                        </th>
                        <th scope="col" class="px-6 py-3 text-lg font-medium text-gray-900">
                            #
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($submitted_applications as $app)
                        <tr @class(['bg-white border-b hover:bg-gray-50',$loop->last?'':'border-b'])>
                            <td class="px-6 py-4 text-base text-gray-600">
                                {{ \Illuminate\Support\Str::of($app->type)->replace('_',' ')->headline() }}
                            </td>
                            <td class="px-6 py-4">
                                @if($app->status==='waiting_for_sgk')
                                    <span
                                        class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded uppercase">Waiting For SGK</span>
                                @endif
                                @if($app->status==='pending')
                                    <span
                                        class="bg-gray-100 text-gray-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded uppercase">Pending</span>
                                @endif
                                @if($app->status==='approved')
                                    <span
                                        class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded uppercase">Approved</span>
                                @endif
                                @if($app->status==='rejected')
                                    <span
                                        class="bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded uppercase">rejected</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-base text-gray-600">
                                {{ $app->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{route('applications.show',['application' => $app->id ,'type' => request()->query('type')??'official_letter_request'])}}" class="font-medium text-indigo-600 underline">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-base text-gray-600">
                                No applications found.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
