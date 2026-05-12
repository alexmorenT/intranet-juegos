<x-app-layout>
    <div class="py-12 px-4">
        <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 shadow-2xl rounded-3xl p-8 border dark:border-gray-700">

            <div class="flex justify-between items-center mb-8 px-4 h-20 bg-gray-50 dark:bg-gray-900/50 rounded-2xl p-4 border border-gray-100 dark:border-gray-700">
                <div class="relative flex items-center">
                    <div class="text-left">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest leading-none mb-1">Tiempo</p>
                        <p id="contador-visual" class="text-4xl font-black text-red-600 tabular-nums">60.0</p>
                    </div>
                    <span id="tiempo-extra" class="absolute -right-16 top-0 text-green-500 font-black text-xl opacity-0 transition-all pointer-events-none"></span>
                </div>

                <div class="text-right">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest leading-none mb-1">Puntos</p>
                    <p id="puntos-realtime" class="text-3xl font-black text-indigo-600">0</p>
                </div>
            </div>

            <div class="flex flex-col items-center justify-center pt-12 space-y-12">

                <div id="bomba-body" class="relative">
                    <div class="absolute -top-10 left-1/2 -translate-x-1/2 w-3 h-10 bg-[#8b4513] rounded-t-lg">
                        <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-6 h-6 bg-orange-500 rounded-full shadow-[0_0_15px_5px_rgba(255,255,0,0.8)] animate-flicker"></div>
                    </div>

                    <div class="w-56 h-56 sm:w-64 sm:h-64 bg-[#222] rounded-full shadow-[inset_-20px_-20px_50px_rgba(0,0,0,0.5)] flex items-center justify-center relative z-10 border-8 border-gray-900">
                        <span id="silaba" class="text-6xl sm:text-7xl font-black text-white uppercase tracking-tighter drop-shadow-2xl">
                            ---
                        </span>
                    </div>
                    <div class="w-40 h-6 bg-black/20 dark:bg-black/40 blur-xl rounded-[100%] mx-auto mt-6"></div>
                </div>

                <div id="overlay-inicio" class="w-full flex justify-center">
                    <button id="btn-empezar" class="bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 px-12 rounded-2xl transition-all uppercase tracking-widest shadow-xl transform hover:scale-105">
                        ¡Encender Mecha!
                    </button>
                </div>

                <div class="w-full flex flex-col items-center">
                    <input type="text" id="input-palabra" disabled
                        class="w-full max-w-sm bg-gray-900 border-4 border-transparent rounded-2xl py-5 px-6 text-3xl font-black text-center transition-all uppercase opacity-50 text-white placeholder:text-gray-500 focus:outline-none"
                        placeholder="ESPERANDO...">
                </div>
            </div>
        </div>
    </div>

    <div id="modal-resultados" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm transition-opacity duration-300">
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl max-w-md w-full overflow-hidden transform transition-all scale-95 opacity-0" id="modal-content">
            <div class="p-8 text-center">
                <h2 class="text-3xl font-black text-gray-800 dark:text-white mb-2 uppercase tracking-tighter">¡BOOM!</h2>
                <p class="text-gray-500 dark:text-gray-400 mb-8">La bomba ha explotado</p>

                <div class="grid grid-cols-2 gap-3 mb-8">
                    <div class="bg-gray-50 dark:bg-gray-900/50 p-4 rounded-2xl border border-gray-100 dark:border-gray-700">
                        <span class="block text-gray-400 text-xs font-bold uppercase mb-1">Palabras</span>
                        <span id="res-intentos" class="text-3xl font-black text-indigo-500">0</span>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-900/50 p-4 rounded-2xl border border-gray-100 dark:border-gray-700">
                        <span class="block text-gray-400 text-xs font-bold uppercase mb-1">Puntos Obtenidos</span>
                        <span id="res-puntos" class="text-3xl font-black text-green-500">0</span>
                    </div>

                    <button onclick="window.location.href='/dashboard'" class="w-full py-4 bg-gray-900 dark:bg-white dark:text-gray-900 text-white font-bold rounded-xl hover:scale-[1.02] transition transform active:scale-95">
                        VOLVER AL DASHBOARD
                    </button>
                </div>
            </div>
        </div>

        <style>
            @keyframes flicker {
                0% {
                    transform: translateX(-50%) scale(1);
                    opacity: 1;
                }

                100% {
                    transform: translateX(-50%) scale(1.3);
                    opacity: 0.8;
                }
            }

            .animate-flicker {
                animation: flicker 0.4s infinite alternate;
            }

            @keyframes shake {

                0%,
                100% {
                    transform: translate(0, 0);
                }

                10%,
                30%,
                50%,
                70%,
                90% {
                    transform: translate(-8px, 0);
                }

                20%,
                40%,
                60%,
                80% {
                    transform: translate(8px, 0);
                }
            }

            .animate-shake {
                animation: shake 0.5s cubic-bezier(.36, .07, .19, .97) both;
            }
        </style>

        <script>
            window.csrfToken = "{{ csrf_token() }}";
            window.bombPartyGameId = 3;
        </script>
        <script src="{{ asset('js/bombparty.js') }}"></script>
</x-app-layout>