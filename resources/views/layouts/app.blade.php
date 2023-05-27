<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased">
<x-banner/>

<div class="min-h-screen bg-gray-100">
    @livewire('navigation-menu')

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto sm:ml-[300px] sm:mr-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main class="relative">
        <div class="absolute left-0">
            <aside id="default-sidebar"
                   class="fixed top-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
                   aria-label="Sidebar">
                <div class="h-full px-3 py-4 overflow-y-auto shadow bg-white border border-gray-100">
                    <ul class="space-y-2 font-medium">
                        <li>
                            <div class="flex items-center p-2 rounded-lg">
                                <x-application-mark class="block h-9 w-auto"/>
                                <span class="ml-3 capitalize">Codecrafters</span>
                            </div>
                        </li>
                        <li>
                            <a href="{{ route('profile.show') }}"
                                @class([
     'group flex items-center p-2 rounded-lg text-sm font-medium leading-5',
     'text-gray-500 hover:text-gray-900 hover:bg-indigo-100' => !request()->routeIs('profile.show'),
     'text-gray-900 bg-indigo-100' =>  request()->routeIs('profile.show'),
 ])>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                     class="w-6 h-6 text-indigo-500">
                                    <path fill-rule="evenodd"
                                          d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                                          clip-rule="evenodd"/>
                                </svg>


                                <span class="ml-3 capitalize">Profile</span>
                            </a>
                        </li>
                        <li>
                            <button
                                data-toggle-menu="applications"
                                data-open="{{ request()->routeIs('applications.index') }}"
                                type="button" @class([
                             'group flex items-center p-2 rounded-lg text-sm font-medium leading-5 w-full',
                             'text-gray-500 hover:text-gray-900 hover:bg-indigo-100' => !(request()->routeIs('applications.index')||request()->routeIs('applications.create')||request()->routeIs('applications.show')),
                             'text-gray-900 bg-indigo-100' =>  (request()->routeIs('applications.index')||request()->routeIs('applications.create'))||request()->routeIs('applications.show')])>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                     class="w-6 h-6 transition duration-75 text-indigo-500">
                                    <path fill-rule="evenodd"
                                          d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0016.5 9h-1.875a1.875 1.875 0 01-1.875-1.875V5.25A3.75 3.75 0 009 1.5H5.625zM7.5 15a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5A.75.75 0 017.5 15zm.75 2.25a.75.75 0 000 1.5H12a.75.75 0 000-1.5H8.25z"
                                          clip-rule="evenodd"/>
                                    <path
                                        d="M12.971 1.816A5.23 5.23 0 0114.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 013.434 1.279 9.768 9.768 0 00-6.963-6.963z"/>
                                </svg>
                                <span class="flex-1 ml-3 text-left whitespace-nowrap">My Applications</span>
                                <svg
                                    @class([
																 'w-6 h-6 transition  duration-150 ease-in-out',
																 'rotate-180' => request()->routeIs('applications.index'),
])
                                    id="applications-arrow"
                                    fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </button>

                            <ul id="applications"
                                @class([
                                                                      'py-2 space-y-2',
                                                                      'hidden' => !(request()->routeIs('applications.index') || request()->routeIs('applications.show') || request()->routeIs('applications.create')),

    ])
                            >
                                <li>
                                    <a href="{{ route('applications.index',['type' => 'official_letter_request']) }}"
                                        @class([
                                 'group flex items-center pl-11 p-2 rounded-lg text-sm font-medium leading-5 w-full',
                                 'text-gray-500 hover:text-gray-900 hover:bg-indigo-100' => !((request()->routeIs('applications.index')||request()->routeIs('applications.create')||request()->routeIs('applications.show')) && request()->query('type')==='official_letter_request'),
                                 'text-gray-900 bg-indigo-100' =>  (request()->routeIs('applications.index') ||request()->routeIs('applications.show')||request()->routeIs('applications.create')  )&& request()->query('type')==='official_letter_request'])
                                    >Official Letter Request</a>
                                </li>
                                <li>
                                    <a href="{{ route('applications.index',['type' => 'internship_application' ]) }}"
                                        @class([
                                 'group flex items-center pl-11 p-2 rounded-lg text-sm font-medium leading-5 w-full',
                                 'text-gray-500 hover:text-gray-900 hover:bg-indigo-100' => !((request()->routeIs('applications.index')||request()->routeIs('applications.create')||request()->routeIs('applications.show')) && request()->query('type')==='internship_application'),
                                 'text-gray-900 bg-indigo-100' =>
                                 (request()->routeIs('applications.index')||request()->routeIs('applications.show')||request()->routeIs('applications.create')) && request()->query('type')==='internship_application'])
                                    >Internship Application</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('messages.index') }}"
                                @class([
     'group flex items-center p-2 rounded-lg text-sm font-medium leading-5',
     'text-gray-500 hover:text-gray-900 hover:bg-indigo-100' => !(request()->routeIs('messages.index')||request()->routeIs('messages.show')||request()->routeIs('messages.create')),
     'text-gray-900 bg-indigo-100' =>  (request()->routeIs('messages.index')||request()->routeIs('messages.show')||request()->routeIs('messages.create')),
 ])>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                     class="w-6 h-6 text-indigo-500">
                                    <path fill-rule="evenodd"
                                          d="M6.912 3a3 3 0 00-2.868 2.118l-2.411 7.838a3 3 0 00-.133.882V18a3 3 0 003 3h15a3 3 0 003-3v-4.162c0-.299-.045-.596-.133-.882l-2.412-7.838A3 3 0 0017.088 3H6.912zm13.823 9.75l-2.213-7.191A1.5 1.5 0 0017.088 4.5H6.912a1.5 1.5 0 00-1.434 1.059L3.265 12.75H6.11a3 3 0 012.684 1.658l.256.513a1.5 1.5 0 001.342.829h3.218a1.5 1.5 0 001.342-.83l.256-.512a3 3 0 012.684-1.658h2.844z"
                                          clip-rule="evenodd"/>
                                </svg>


                                <span class="ml-3 capitalize">Inbox</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('announcements.index') }}"
                                @class([
     'group flex items-center p-2 rounded-lg text-sm font-medium leading-5',
     'text-gray-500 hover:text-gray-900 hover:bg-indigo-100' => !request()->routeIs('announcements.index'),
     'text-gray-900 bg-indigo-100' =>  request()->routeIs('announcements.index'),
 ])>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                     class="w-6 h-6 text-indigo-500">
                                    <path fill-rule="evenodd"
                                          d="M1.5 9.832v1.793c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875V9.832a3 3 0 00-.722-1.952l-3.285-3.832A3 3 0 0016.215 3h-8.43a3 3 0 00-2.278 1.048L2.222 7.88A3 3 0 001.5 9.832zM7.785 4.5a1.5 1.5 0 00-1.139.524L3.881 8.25h3.165a3 3 0 012.496 1.336l.164.246a1.5 1.5 0 001.248.668h2.092a1.5 1.5 0 001.248-.668l.164-.246a3 3 0 012.496-1.336h3.165l-2.765-3.226a1.5 1.5 0 00-1.139-.524h-8.43z"
                                          clip-rule="evenodd"/>
                                    <path
                                        d="M2.813 15c-.725 0-1.313.588-1.313 1.313V18a3 3 0 003 3h15a3 3 0 003-3v-1.688c0-.724-.588-1.312-1.313-1.312h-4.233a3 3 0 00-2.496 1.336l-.164.246a1.5 1.5 0 01-1.248.668h-2.092a1.5 1.5 0 01-1.248-.668l-.164-.246A3 3 0 007.046 15H2.812z"/>
                                </svg>


                                <span class="ml-3 capitalize">Announcements</span>
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <a href="{{ route('announcements.index') }}"
                                   @click.prevent="$root.submit();"
                                   class="group flex items-center p-2 rounded-lg text-sm font-medium leading-5 text-gray-500 hover:text-gray-900 hover:bg-indigo-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                         class="w-6 h-6 text-indigo-500">
                                        <path fill-rule="evenodd"
                                              d="M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9A.75.75 0 0115 9V5.25a1.5 1.5 0 00-1.5-1.5h-6zm10.72 4.72a.75.75 0 011.06 0l3 3a.75.75 0 010 1.06l-3 3a.75.75 0 11-1.06-1.06l1.72-1.72H9a.75.75 0 010-1.5h10.94l-1.72-1.72a.75.75 0 010-1.06z"
                                              clip-rule="evenodd"/>
                                    </svg>

                                    <span class="ml-3 capitalize">{{ __('Log Out') }}</span>
                                </a>
                            </form>
                        </li>

                    </ul>
                </div>
            </aside>
        </div>
        <div class="sm:ml-64">
            {{ $slot }}
        </div>
    </main>
</div>

@stack('modals')

@livewireScripts
<script>
    document.querySelectorAll('[data-toggle-menu]').forEach(function (element) {
        element.addEventListener('click', function () {
            document.getElementById(`${this.dataset.toggleMenu}-arrow`).classList.toggle('rotate-180');
            document.getElementById(this.dataset.toggleMenu).classList.toggle('hidden');
        });
    });
</script>
</body>
</html>
