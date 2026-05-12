<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            TypeSpeed: Desafío de Velocidad
        </h2>
    </x-slot>

    <div class="py-8 px-4">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-3xl p-6 border dark:border-gray-700">

                <div class="flex justify-between items-center mb-6 px-4">
                    <div class="text-center">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Velocidad</p>
                        <p class="text-3xl font-black text-indigo-600"><span id="wpm-realtime">0</span> <small class="text-sm">WPM</small></p>
                    </div>
                    <div id="caps-warning" class="hidden animate-pulse text-red-500 font-bold text-sm">
                        ⚠️ BLOQ MAYÚS ACTIVADO
                    </div>
                </div>

                <div id="contenedor" class="bg-gray-50 dark:bg-gray-900/50 rounded-3xl border-2 border-dashed border-gray-200 dark:border-gray-700 shadow-inner flex flex-wrap justify-center items-center overflow-y-auto p-8 relative">
                    <button id="iniciar" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-12 rounded-2xl transition transform active:scale-95 shadow-xl">
                        EMPEZAR PRUEBA
                    </button>
                </div>

                <input type="text" id="input-movil"
                    autocorrect="off"
                    autocapitalize="none"
                    spellcheck="false"
                    autocomplete="off"
                    style="position: absolute; opacity: 0; pointer-events: none; z-index: -1; left: -9999px;">

                <div id="virtual-keyboard" class="mt-8 opacity-30 transition-opacity duration-500 pointer-events-none">
                    @php
                    $filas = [
                    ['q','w','e','r','t','y','u','i','o','p'],
                    ['a','s','d','f','g','h','j','k','l','ñ'],
                    ['z','x','c','v','b','n','m',',','.']
                    ];
                    @endphp
                    @foreach($filas as $fila)
                    <div class="flex justify-center gap-1 mb-2">
                        @foreach($fila as $tecla)
                        <div data-key="{{ $tecla }}" class="key w-10 sm:w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded flex items-center justify-center font-bold text-gray-500 dark:text-gray-300 uppercase text-[10px] sm:text-xs border-b-4 border-gray-300 dark:border-gray-900 transition-all">
                            {{ $tecla }}
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                    <div class="flex justify-center">
                        <div data-key=" " class="key w-64 h-12 bg-gray-100 dark:bg-gray-700 rounded flex items-center justify-center font-bold text-gray-500 dark:text-gray-300 uppercase text-xs border-b-4 border-gray-300 dark:border-gray-900 transition-all">
                            ESPACIO
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-resultados" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm transition-opacity duration-300">
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl max-w-md w-full overflow-hidden transform transition-all scale-95 opacity-0" id="modal-content">
            <div class="p-8 text-center">
                <h2 class="text-3xl font-black text-gray-800 dark:text-white mb-2 uppercase tracking-tighter">¡Prueba Finalizada!</h2>
                <p class="text-gray-500 dark:text-gray-400 mb-8">Has completado el desafío con éxito.</p>

                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="bg-gray-50 dark:bg-gray-900/50 p-4 rounded-2xl border border-gray-100 dark:border-gray-700">
                        <p class="text-xs font-bold text-gray-400 uppercase">Velocidad</p>
                        <p class="text-2xl font-black text-indigo-600"><span id="res-wpm">0</span> <small class="text-xs">WPM</small></p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-900/50 p-4 rounded-2xl border border-gray-100 dark:border-gray-700">
                        <p class="text-xs font-bold text-gray-400 uppercase">Precisión</p>
                        <p class="text-2xl font-black text-green-500"><span id="res-precision">0</span><small class="text-xs">%</small></p>
                    </div>
                </div>

                <div class="bg-indigo-600 p-6 rounded-2xl mb-8 shadow-lg shadow-indigo-200 dark:shadow-none">
                    <p class="text-white/80 text-xs font-bold uppercase mb-1">Puntos Obtenidos</p>
                    <p class="text-white text-5xl font-black" id="res-puntos">0</p>
                </div>

                <button onclick="window.location.href='/dashboard'" class="w-full py-4 bg-gray-900 dark:bg-white dark:text-gray-900 text-white font-bold rounded-xl hover:scale-[1.02] transition transform active:scale-95">
                    VOLVER AL DASHBOARD
                </button>
            </div>
        </div>
    </div>

    <style>
        #contenedor {
            max-height: 250px;
            overflow-y: auto;
            scroll-behavior: smooth;
            padding-bottom: 2rem;
            line-height: 3.5rem;
        }

        /* Ocultar scrollbar */
        #contenedor::-webkit-scrollbar {
            display: none;
        }

        .type-char {
            width: 1.2ch;
            height: 2.5rem;
            background: transparent;
            border: none;
            border-bottom: 2px solid rgba(0, 0, 0, 0.1);
            outline: none;
            text-align: center;
            font-family: 'Courier New', monospace;
            font-weight: 700;
            font-size: 1.8rem;
            margin: 0 1px;
            padding: 0;
            display: inline-block;
            transition: all 0.2s ease;
        }

        .dark .type-char {
            border-bottom-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        /* CURSOR VIRTUAL (Resaltado de letra activa) */
        .letra-activa {
            border-bottom: 4px solid #6366f1 !important;
            background-color: rgba(99, 102, 241, 0.15);
            animation: parpadeo-cursor 0.3s infinite;
            transform: scale(1.1);
            border-radius: 4px 4px 0 0;
        }

        @keyframes parpadeo-cursor {

            0%,
            100% {
                border-color: #6366f1;
            }

            50% {
                border-color: transparent;
            }
        }

        /* Colores de acierto/error */
        .key-success {
            background-color: #22c55e !important;
            color: white !important;
            border-bottom-width: 0 !important;
            transform: translateY(4px);
        }

        .key-error {
            background-color: #ef4444 !important;
            color: white !important;
            border-bottom-width: 0 !important;
            transform: translateY(4px);
        }

        /* Opacidad para letras ya escritas */
        .type-char[style*="color"] {
            opacity: 0.6;
        }
    </style>

    <script>
        window.csrfToken = "{{ csrf_token() }}";
        window.typeSpeedGameId = 2;
    </script>
    <script src="{{ asset('js/type.js') }}"></script>
</x-app-layout>