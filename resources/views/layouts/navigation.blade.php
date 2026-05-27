<div class="flex flex-col h-full overflow-y-auto" x-data="{ openAccount: false }">
    <div class="p-6 border-b border-gray-100 dark:border-gray-700 relative">
        <div class="flex justify-center mb-4">
            <button @click="openAccount = !openAccount" class="focus:outline-none group relative">
                <div class="relative h-20 w-20">
                    @if(Auth::user()->frame_id > 0)
                    <img src="{{ asset('storage/frames/frame-' . Auth::user()->frame_id . '.png') }}"
                        class="absolute inset-0 z-10 h-full w-full object-cover scale-150 pointer-events-none" style="height: 85px; width: 85px;"
                        alt="Marco">
                    @endif

                    <div class="h-full w-full rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold text-2xl shadow-lg overflow-hidden group-hover:ring-4 group-hover:ring-indigo-200 transition-all">
                        @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="h-full w-full object-cover">
                        @else
                        {{ substr(Auth::user()->name, 0, 1) }}
                        @endif
                    </div>
                </div>
            </button>
        </div>

        <div class="text-center">
            <button @click="openAccount = !openAccount" class="flex items-center justify-center w-full focus:outline-none">
                <p class="font-bold text-gray-800 dark:text-white truncate mr-1">{{ Auth::user()->name }}</p>
                <svg class="w-4 h-4 text-gray-400 transform transition-transform duration-200" :class="{'rotate-180': openAccount}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <p class="text-xs text-green-500 font-medium mt-1">● En línea</p>
        </div>

        <div x-show="openAccount"
            @click.away="openAccount = false"
            x-transition:enter="transition ease-out duration-100"
            class="absolute left-6 right-6 mt-2 py-2 bg-white dark:bg-gray-700 rounded-2xl shadow-xl border dark:border-gray-600 z-50">
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-indigo-50 dark:hover:bg-gray-600">
                {{ __('Mi Perfil') }}
            </a>
            <div class="border-t dark:border-gray-600 my-1"></div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </div>

    <nav class="flex-grow p-4 space-y-2">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Inicio</x-nav-link>
        <x-nav-link :href="route('estadisticas')" :active="request()->routeIs('estadisticas')">Estadísticas</x-nav-link>
        <x-nav-link :href="route('ranking')" :active="request()->routeIs('ranking')">Ranking</x-nav-link>
        <x-nav-link :href="route('tienda')" :active="request()->routeIs('tienda')">Tienda</x-nav-link>
    </nav>

    <div class="mt-auto mb-20 w-full flex justify-center p-4">
        <a href="{{ route('tienda') }}"
            class="block w-full max-w-[200px] rounded-2xl overflow-hidden shadow-sm transition duration-300 group relative hover:scale-105 hover:shadow-lg border border-transparent">

            <img src="{{ asset('storage/images/banner-vertical.png') }}"
                class="w-full h-full object-cover transition duration-500"
                alt="Publicidad">
        </a>
    </div>

</div>