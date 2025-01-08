@php
    use Illuminate\Support\Facades\Auth;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <!-- component -->
    <div class="flex flex-wrap bg-gray-200 w-full h-screen">
        <div class="w-2/12 h-full bg-white relative rounded p-3 shadow-lg">
            <div class="flex items-center space-x-4 p-2 mb-5">
                <x-application-logo class="w-12 h-12"></x-application-logo>
                <div>
                    <div class="grid grid-row-2">
                        <h4 class="font-semibold text-lg text-gray-700 capitalize font-poppins tracking-wide">
                            {{ Auth::user()->name }}
                        </h4>
                    </div>
                    </h4>
                    <span class="text-sm tracking-wide flex items-center space-x-1">
                        @if (auth()->user()->role == 'admin')
                            <svg class="h-4 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>

                        @endif
                        <span class="text-gray-600">{{ Auth::user()->role }}</span>
                    </span>
                </div>
            </div>
            <div class="flex flex-col h-5/6 justify-between">
                <ul class="space-y-2 text-sm">
                    <li>
                        <x-sidebar-link :href="route('managekamar')" :active="request()->routeIs('managekamar')"
                            wire:navigate>
                            <div class="flex gap-2">
                                <div class="text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819" />
                                    </svg>
                                </div>
                                <div>
                                    {{ __('Kelola Kamar') }}
                                </div>
                            </div>
                        </x-sidebar-link>
                    </li>

                    <li x-data="{ open: false }">
                        <x-sidebar-link :active="request()->routeIs('layanan') || request()->routeIs('reservasi') || request()->routeIs('pembayaran')" wire:navigate @click.prevent="open = !open">
                            <div class="flex gap-2">
                                <div class="text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                                    </svg>
                                </div>
                                <div>
                                    {{ __('Kelola Layanan') }}
                                </div>
                            </div>
                        </x-sidebar-link>

                        <!-- Submenu -->
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95" id="submenulayanan"
                            class="space-y-2 pl-3 pt-2">
                            <ul>
                                <li>
                                    <x-sidebar-link :href="route('layanan')"
                                       :active="request()->routeIs('layanan')" wire:navigate>
                                        <div class="flex gap-2">
                                            <div class="text-gray-700"></div>
                                            <div>{{ __('Manajemen Layanan') }}</div>
                                        </div>
                                    </x-sidebar-link>
                                </li>
                                <li>
                                    <x-sidebar-link :href="route('reservasi')" :active="request()->routeIs('reservasi')"
                                        wire:navigate>
                                        <div class="flex gap-2">
                                            <div class="text-gray-700"></div>
                                            <div>{{ __('Manajemen Reservasi') }}</div>
                                        </div>
                                    </x-sidebar-link>
                                </li>
                                <li>
                                    <x-sidebar-link :href="route('pembayaran')"
                                        :active="request()->routeIs('pembayaran')" wire:navigate>
                                        <div class="flex gap-2">
                                            <div class="text-gray-700"></div>
                                            <div>{{ __('Manajemen Pembayaran') }}</div>
                                        </div>
                                    </x-sidebar-link>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <x-sidebar-link :href="route('profile')" :active="request()->routeIs('profile')" wire:navigate>
                            <div class="flex gap-2">
                                <div class="text-gray-700">
                                    <svg class="h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    {{ __('Profile') }}
                                </div>
                            </div>
                        </x-sidebar-link>
                    </li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit"
                                class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline w-full text-left">
                                <div class="text-gray-700">
                                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                </div>
                                <div>
                                    {{ __('Logout') }}
                                </div>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <div class="w-10/12">
            <div class="text-gray-500">
                @if (isset($header))
                    <header class="bg-white dark:bg-gray-800 shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                {{ $slot }}
            </div>
        </div>
    </div>
    @livewireScripts
</body>

</html>