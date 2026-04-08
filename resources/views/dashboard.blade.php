<x-app-layout>
    <header class="bg-white dark:bg-gray-800 shadow-sm border-b dark:border-gray-700">
        <div class="max-w-5xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Panel de Control') }}
            </h2>
        </div>
    </header>

    <div class="py-12 px-4">
        <div class="max-w-5xl mx-auto">
            <div class="mb-10 bg-gradient-to-r from-indigo-600 to-purple-700 rounded-3xl p-8 text-white shadow-xl">
                <h1 class="text-3xl font-bold mb-2">¡Hola, {{ Auth::user()->name }}!</h1>
                <p class="text-indigo-100 italic">"La agilidad mental es el músculo que más brilla."</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
                <div class="bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-sm border dark:border-gray-700 text-center">
                    <p class="text-gray-500 text-xs uppercase font-bold">Puntos Totales</p>
                    <p class="text-xl font-black text-indigo-600">{{ number_format($puntosTotales) }}</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-sm border dark:border-gray-700 text-center">
                    <p class="text-gray-500 text-xs uppercase font-bold">Ranking Depto.</p>
                    <p class="text-xl font-black text-green-500">#{{ $posicion }}</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-sm border dark:border-gray-700 text-center">
                    <p class="text-gray-500 text-xs uppercase font-bold">Juegos Hoy</p>
                    <p class="text-xl font-black text-orange-500">{{ $juegosHoy }}/3</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-sm border dark:border-gray-700 text-center">
                    <p class="text-gray-500 text-xs uppercase font-bold">Racha</p>
                    <p class="text-xl font-black text-red-500">🔥 5 días</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm overflow-hidden border border-gray-100 dark:border-gray-700 group hover:shadow-2xl transition-all duration-300 text-center">
                    <div class="h-28 bg-green-500 flex items-center justify-center text-5xl group-hover:scale-110 transition-transform duration-300 shadow-inner">
                        🔡
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-xl mb-2 text-gray-800 dark:text-white uppercase tracking-tight">
                            Wordle
                        </h3>
                        @if($yaJugoWordle)
                        <button disabled class="inline-block w-full py-3 bg-gray-400 text-white font-bold rounded-xl cursor-not-allowed">
                            YA HAS JUGADO HOY
                        </button>
                        @else
                        <a href="{{ route('juegos.wordle') }}" class="inline-block w-full py-3 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 transition">
                            JUGAR
                        </a>
                        @endif
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm overflow-hidden border border-gray-100 dark:border-gray-700 group hover:shadow-2xl transition-all duration-300 text-center">
                    <div class="h-28 bg-blue-500 flex items-center justify-center text-5xl group-hover:scale-110 transition-transform duration-300 shadow-inner">
                        ⌨️
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-xl mb-2 text-gray-800 dark:text-white uppercase tracking-tight">
                            TypeSpeed
                        </h3>
                        @if($yaJugoTypeSpeed)
                        <button disabled class="inline-block w-full py-3 bg-gray-400 text-white font-bold rounded-xl cursor-not-allowed">
                            YA HAS JUGADO HOY
                        </button>
                        @else
                        <a href="{{ route('juegos.typespeed') }}" class="inline-block w-full py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition transform active:scale-95 shadow-lg shadow-blue-100 dark:shadow-none">
                            JUGAR
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>