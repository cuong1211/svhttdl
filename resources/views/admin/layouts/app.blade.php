<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'SVHTTDL') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
    <style>
        .sidebar-collapsed {
            width: 0!important
            /* Adjust the width when sidebar is collapsed */
        }
        .transition-width {
            transition: width 0.3s ease;
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="bg-gray-100 flex min-h-screen ">
        {{-- @include('admin.layouts.navigation') --}}
        <x-admin.sidebar.sidebar />
        <main class="w-full bg-blue-50 text-base">
            <div class="flex h-auto bg-white p-3">
                <button class="btn btn-square btn-ghost btn-sm" id="toggleButton">
                    <x-heroicon-c-bars-3 class="size-5" />
                </button>
                <!-- Settings Dropdown -->
                <div class="hidden sm:ms-6 sm:flex sm:items-center" style="margin-left: auto">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="text-gray-500 hover:text-gray-700 inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 transition duration-150 ease-in-out focus:outline-none">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                @lang('admin.profile')
                            </x-dropdown-link>
                            <x-dropdown-link target="__blank" :href="route('home')">
                                @lang('admin.link_to_website')
                            </x-dropdown-link>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    @lang('admin.logout')
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
            
            {{ $slot }}
        </main>
    </div>
    <script>
        const toggleButton = document.getElementById('toggleButton');
        const sidebar = document.getElementById('sidebar');
        toggleButton.addEventListener('click', () => {
            // sidebar.classList.toggle('sidebar-expanded');
            sidebar.classList.toggle('sidebar-collapsed');
        });
    </script>
    @stack('bottom_scripts')
</body>

</html>
