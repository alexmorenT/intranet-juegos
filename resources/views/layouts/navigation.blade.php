<div class="flex flex-col h-full overflow-y-auto">
    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
        <div class="flex justify-center mb-4">
            <div class="h-16 w-16 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold text-2xl shadow-lg">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
        </div>
        <div class="text-center">
            <p class="font-bold text-gray-800 dark:text-white truncate">{{ Auth::user()->name }}</p>
            <p class="text-xs text-green-500 font-medium">● En línea</p>
        </div>
    </div>

    <nav class="flex-grow p-4 space-y-2">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Inicio') }}
        </x-nav-link>
        <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
            {{ __('Mi Perfil') }}
        </x-nav-link>
    </nav>

    <div class="p-4 border-t border-gray-100 dark:border-gray-700">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center w-full px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-50 rounded-lg transition">
                Cerrar Sesión
            </button>
        </form>
    </div>
</div>