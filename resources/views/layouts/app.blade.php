<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900" x-data="{ openMobile: false }">
    <div class="min-h-screen flex flex-col md:flex-row">

        <aside class="hidden md:block w-64 flex-shrink-0 bg-white dark:bg-gray-800 border-r dark:border-gray-700">
            @include('layouts.navigation')
        </aside>

        <div class="md:hidden bg-white dark:bg-gray-800 p-4 shadow-sm flex justify-between items-center border-b dark:border-gray-700">
            <x-application-logo class="h-8 w-auto fill-current text-gray-800 dark:text-gray-200" />
            <button @click="openMobile = !openMobile" class="p-2 text-gray-500 focus:outline-none">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path :class="{'hidden': openMobile, 'inline-flex': !openMobile }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': !openMobile, 'inline-flex': openMobile }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div x-show="openMobile"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            class="md:hidden bg-white dark:bg-gray-800 border-b dark:border-gray-700">
            <div class="pt-2 pb-3 space-y-1 px-4">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Inicio') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                    {{ __('Mi Perfil') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Cerrar Sesión') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>

        <div class="flex-1 overflow-x-hidden">
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>