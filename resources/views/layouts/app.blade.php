<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <title>{{ config('app.name', 'Intranet Arcade') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900" x-data="{ openMobile: false, openUserMobile: false }">
    <div class="min-h-screen flex flex-col md:flex-row">

        <aside class="hidden md:block w-64 flex-shrink-0 bg-white dark:bg-gray-800 border-r dark:border-gray-700">
            @include('layouts.navigation')
        </aside>

<header class="md:hidden bg-white dark:bg-gray-800 border-b dark:border-gray-700 p-4 flex justify-between items-center sticky top-0 z-50">
    <button @click="openMobile = !openMobile" class="p-2 text-gray-500 focus:outline-none">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path x-show="!openMobile" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path x-show="openMobile" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <span class="font-black text-indigo-600 dark:text-indigo-400 text-xl tracking-tighter">ARCADE</span>

    <div class="relative">
        <button @click="openUserMobile = !openUserMobile" class="focus:outline-none">
            <div class="relative h-10 w-10">
                @if(Auth::user()->frame_id > 0)
                    <img src="{{ asset('storage/frames/frame-' . Auth::user()->frame_id . '.png') }}" 
                         class="absolute inset-0 z-10 h-full w-full object-contain scale-125 pointer-events-none">
                @endif
                <div class="h-full w-full rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold text-sm shadow-sm overflow-hidden ring-2 ring-indigo-100 dark:ring-indigo-900">
                    @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="h-full w-full object-cover">
                    @else
                        {{ substr(Auth::user()->name, 0, 1) }}
                    @endif
                </div>
            </div>
        </button>

        <div x-show="openUserMobile" @click.away="openUserMobile = false"
             class="absolute right-0 mt-3 w-48 bg-white dark:bg-gray-700 rounded-2xl shadow-xl border dark:border-gray-600 z-[60]">
            <div class="px-4 py-3 border-b dark:border-gray-600">
                <p class="text-sm font-bold text-gray-800 dark:text-white truncate">{{ Auth::user()->name }}</p>
            </div>
            <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-sm text-gray-700 dark:text-gray-200">Mi Perfil</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-3 text-sm text-red-600">Cerrar Sesión</button>
            </form>
        </div>
    </div>
</header>

        <div x-show="openMobile"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="md:hidden bg-white dark:bg-gray-800 border-b dark:border-gray-700 shadow-lg">
            <div class="pt-2 pb-4 space-y-1 px-4">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Inicio') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('estadisticas')" :active="request()->routeIs('estadisticas')">
                    {{ __('Estadísticas') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('ranking')" :active="request()->routeIs('ranking')">
                    {{ __('Ranking') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('ranking')" :active="request()->routeIs('ranking')">
                    {{ __('Tienda') }}
                </x-responsive-nav-link>

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