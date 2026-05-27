<x-app-layout>

    <div class="py-12 px-4 max-w-6xl mx-auto">
        <div>
            <div class="mb-10 bg-white dark:bg-gray-800 rounded-lg p-8 border border-gray-200 dark:border-gray-700">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">¡Hola, {{ Auth::user()->name }}!</h1>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-700 text-center shadow-sm">
                    <p class="text-gray-500 text-xs uppercase font-bold">Puntos Totales</p>
                    <p class="text-xl font-black text-indigo-600 font-mono mt-1">{{ number_format($puntosTotales) }}</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-700 text-center shadow-sm">
                    <p class="text-gray-500 text-xs uppercase font-bold">Ranking Depto.</p>
                    <p class="text-xl font-black text-green-500 font-mono mt-1">#{{ $posicion }}</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-700 text-center shadow-sm">
                    <p class="text-gray-500 text-xs uppercase font-bold">Juegos Hoy</p>
                    <p class="text-xl font-black text-orange-500 font-mono mt-1">{{ $juegosHoy }}/3</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-700 text-center shadow-sm">
                    <p class="text-gray-500 text-xs uppercase font-bold">Racha</p>
                    <p class="text-xl font-black text-red-500 font-mono mt-1">🔥 {{ $racha }}</p>
                </div>
            </div>

            <div class="space-y-4" x-data="{ abierto: null }">

                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm">
                    <div @click="abierto = (abierto === 1 ? null : 1)" class="p-6 bg-emerald-600 text-white flex items-center justify-between cursor-pointer hover:bg-emerald-700 transition relative">
                        <div class="flex items-center space-x-4 relative z-10">
                            <div>
                                <h3 class="font-black text-2xl uppercase tracking-tight">Wordle</h3>
                                <p class="text-xs text-emerald-100/80">Descubre la palabra oculta del día</p>
                            </div>
                        </div>
                        <span class="text-7xl md:text-8xl font-black uppercase tracking-tighter opacity-15 absolute right-16 select-none pointer-events-none transform translate-y-1">Wordle</span>
                        <span class="text-emerald-200 font-bold text-xl transition-transform duration-300 relative z-10" :class="abierto === 1 ? 'rotate-180' : ''">▼</span>
                    </div>

                    <div x-show="abierto === 1" x-collapse style="display: none;">
                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/10 text-gray-800 dark:text-gray-100">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                                <div class="space-y-4">
                                    <h4 class="font-bold text-white-600 dark:text-emerald-400 uppercase text-sm tracking-wider">¿Cómo jugar?</h4>
                                    <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-2 list-disc list-inside">
                                        <li>Adivina la palabra oculta en un máximo de 6 intentos.</li>
                                        <li>Cada intento debe ser una palabra válida de 5 letras.</li>
                                        <li><strong class="text-emerald-500">Verde:</strong> Letra correcta en la posición correcta.</li>
                                        <li><strong class="text-amber-500">Amarillo:</strong> Letra en la palabra pero en posición incorrecta.</li>
                                    </ul>
                                    <div class="pt-2">
                                        @if($yaJugoWordle)
                                        <button disabled class="w-full py-3 bg-gray-400 text-white font-bold rounded-md cursor-not-allowed uppercase text-xs tracking-widest">YA HAS JUGADO HOY</button>
                                        @else
                                        <a href="{{ route('juegos.wordle') }}" class="inline-block text-center w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-md transition uppercase text-xs tracking-widest shadow-sm">JUGAR AHORA</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="bg-gray-100 dark:bg-gray-900 h-48 rounded-md flex items-center justify-center text-gray-400 dark:text-gray-500 text-sm overflow-hidden border border-gray-200 dark:border-gray-700">
                                    <video class="w-full h-full object-cover" style="object-position: 50% 20%;" autoplay loop muted playsinline>
                                        <source src="{{ asset('storage/videos/example-wordle.mp4') }}" type="video/mp4">
                                        Tu navegador no soporta la reproducción de vídeo.
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm">
                    <div @click="abierto = (abierto === 2 ? null : 2)" class="p-6 bg-blue-600 text-white flex items-center justify-between cursor-pointer hover:bg-blue-700 transition relative">
                        <div class="flex items-center space-x-4 relative z-10">
                            <div>
                                <h3 class="font-black text-2xl uppercase tracking-tight">TypeSpeed</h3>
                                <p class="text-xs text-blue-100/80">Prueba tus reflejos y pulsaciones por minuto</p>
                            </div>
                        </div>
                        <span class="text-6xl md:text-8xl font-black uppercase tracking-tighter opacity-15 absolute right-16 select-none pointer-events-none transform translate-y-1">TypeSpeed</span>
                        <span class="text-blue-200 font-bold text-xl transition-transform duration-300 relative z-10" :class="abierto === 2 ? 'rotate-180' : ''">▼</span>
                    </div>

                    <div x-show="abierto === 2" x-collapse style="display: none;">
                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/10 text-gray-800 dark:text-gray-100">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                                <div class="space-y-4">
                                    <h4 class="font-bold text-blue-600 dark:text-blue-400 uppercase text-sm tracking-wider">¿Cómo jugar?</h4>
                                    <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-2 list-disc list-inside">
                                        <li>Escribe la frase en pantalla lo más rápido que puedas.</li>
                                        <li>El sistema medirá tus palabras por minuto (WPM) y precisión.</li>
                                        <li>¡Mantén una precisión superior al 95% para obtener bonificaciones de monedas!</li>
                                    </ul>
                                    <div class="pt-2">
                                        @if($yaJugoTypeSpeed)
                                        <button disabled class="w-full py-3 bg-gray-400 text-white font-bold rounded-md cursor-not-allowed uppercase text-xs tracking-widest">YA HAS JUGADO HOY</button>
                                        @else
                                        <a href="{{ route('juegos.typespeed') }}" class="inline-block text-center w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-md transition uppercase text-xs tracking-widest shadow-sm">JUGAR AHORA</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="bg-gray-100 dark:bg-gray-900 h-48 rounded-md flex items-center justify-center text-gray-400 dark:text-gray-500 text-sm overflow-hidden border border-gray-200 dark:border-gray-700">
                                    <video class="w-full h-full object-cover" style="object-position: 10% 20%;" autoplay loop muted playsinline>
                                        <source src="{{ asset('storage/videos/example-typespeed.mp4') }}" type="video/mp4">
                                        Tu navegador no soporta la reproducción de vídeo.
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm">
                    <div @click="abierto = (abierto === 3 ? null : 3)" class="p-6 bg-rose-600 text-white flex items-center justify-between cursor-pointer hover:bg-rose-700 transition relative">
                        <div class="flex items-center space-x-4 relative z-10">
                            <div>
                                <h3 class="font-black text-2xl uppercase tracking-tight">Bomb Party</h3>
                                <p class="text-xs text-rose-100/80">Piensa rápido antes de que la mecha se agote</p>
                            </div>
                        </div>
                        <span class="text-6xl md:text-8xl font-black uppercase tracking-tighter opacity-15 absolute right-16 select-none pointer-events-none transform translate-y-1">BombParty</span>
                        <span class="text-rose-200 font-bold text-xl transition-transform duration-300 relative z-10" :class="abierto === 3 ? 'rotate-180' : ''">▼</span>
                    </div>

                    <div x-show="abierto === 3" x-collapse style="display: none;">
                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/10 text-gray-800 dark:text-gray-100">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                                <div class="space-y-4">
                                    <h4 class="font-bold text-rose-600 dark:text-rose-400 uppercase text-sm tracking-wider">¿Cómo jugar?</h4>
                                    <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-2 list-disc list-inside">
                                        <li>Aparecerá una sílaba aleatoria en el centro de la bomba.</li>
                                        <li>Debes escribir una palabra real en español que contenga esa sílaba.</li>
                                        <li>Cada acierto añade tiempo extra al cronómetro general.</li>
                                    </ul>
                                    <div class="pt-2">
                                        @if($yaJugoBombParty)
                                        <button disabled class="w-full py-3 bg-gray-400 text-white font-bold rounded-md cursor-not-allowed uppercase text-xs tracking-widest">YA HAS JUGADO HOY</button>
                                        @else
                                        <a href="{{ route('juegos.bombparty') }}" class="inline-block text-center w-full py-3 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-md transition uppercase text-xs tracking-wider shadow-sm">JUGAR AHORA</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="bg-gray-100 dark:bg-gray-900 h-48 rounded-md flex items-center justify-center text-gray-400 dark:text-gray-500 text-sm overflow-hidden border border-gray-200 dark:border-gray-700">
                                    <video class="w-full h-full object-cover" style="object-position: 30% 27%;" autoplay loop muted playsinline>
                                        <source src="{{ asset('storage/videos/example-bombparty.mp4') }}" type="video/mp4">
                                        Tu navegador no soporta la reproducción de vídeo.
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>