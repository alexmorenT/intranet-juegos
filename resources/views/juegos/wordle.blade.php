<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-3xl p-8 border border-gray-100 dark:border-gray-700">

                <h1 class="text-3xl font-black text-center mb-8 text-gray-800 dark:text-white uppercase tracking-tighter">
                    Palabra del Día
                </h1>
                <div class="mt-8 text-center text-gray-500 dark:text-gray-400 text-sm italic">
                    Escribe una letra y pulsa ENTER al terminar la fila
                </div>
                <div class="text-center mb-4">
                    <span id="timer-display" class="font-mono text-xl text-indigo-600 dark:text-indigo-400">00:00</span>
                </div>

                <style>
                    /* Encapsulamos los bloques dentro del contenedor del juego */
                    #game-container .blocks {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        gap: 8px;
                        height: 75px;
                        margin-bottom: 8px;
                        background: transparent;
                    }

                    #game-container .block {
                        display: inline-block;
                        height: 65px;
                        width: 65px;
                        border: 2px solid #d1d5db;
                        border-radius: 12px;
                        text-align: center;
                        font-size: 32px;
                        font-weight: bold;
                        color: #1f2937;
                        background-color: white;
                        text-transform: uppercase;
                        transition: all 0.2s;
                    }

                    /* Soporte para modo oscuro encapsulado */
                    .dark #game-container .block {
                        background-color: #374151;
                        border-color: #4b5563;
                        color: white;
                    }

                    #game-container .block:focus {
                        outline: none;
                        border: 3px solid #6366f1;
                        transform: scale(1.05);
                    }
                </style>

                <div id="game-container">
                    <div class="blocks" id="primer-try">
                        <input class="block" maxlength="1" disabled>
                        <input class="block" maxlength="1" disabled>
                        <input class="block" maxlength="1" disabled>
                        <input class="block" maxlength="1" disabled>
                        <input class="block" maxlength="1" disabled>
                    </div>

                    <div class="blocks" id="segundo-try">
                        <input class="block" maxlength="1" disabled>
                        <input class="block" maxlength="1" disabled>
                        <input class="block" maxlength="1" disabled>
                        <input class="block" maxlength="1" disabled>
                        <input class="block" maxlength="1" disabled>
                    </div>

                    <div class="blocks" id="tercer-try">
                        <input class="block" maxlength="1" disabled>
                        <input class="block" maxlength="1" disabled>
                        <input class="block" maxlength="1" disabled>
                        <input class="block" maxlength="1" disabled>
                        <input class="block" maxlength="1" disabled>
                    </div>

                    <div class="blocks" id="cuarto-try">
                        <input class="block" maxlength="1" disabled>
                        <input class="block" maxlength="1" disabled>
                        <input class="block" maxlength="1" disabled>
                        <input class="block" maxlength="1" disabled>
                        <input class="block" maxlength="1" disabled>
                    </div>

                    <div class="blocks" id="quinto-try">
                        <input class="block" maxlength="1" disabled>
                        <input class="block" maxlength="1" disabled>
                        <input class="block" maxlength="1" disabled>
                        <input class="block" maxlength="1" disabled>
                        <input class="block" maxlength="1" disabled>
                    </div>

                    <div class="blocks" id="sexto-try">
                        <input class="block" maxlength="1" disabled>
                        <input class="block" maxlength="1" disabled>
                        <input class="block" maxlength="1" disabled>
                        <input class="block" maxlength="1" disabled>
                        <input class="block" maxlength="1" disabled>
                    </div>
                </div>

                <div id="keyboard" class="mt-10 max-w-lg mx-auto">
                    @php
                    $filas = [
                    ['Q', 'W', 'E', 'R', 'T', 'Y', 'U', 'I', 'O', 'P'],
                    ['A', 'S', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'Ñ'],
                    ['ENTER', 'Z', 'X', 'C', 'V', 'B', 'N', 'M', 'BORRAR']
                    ];
                    @endphp

                    @foreach($filas as $fila)
                    <div class="flex justify-center gap-1 mb-2">
                        @foreach($fila as $tecla)
                        <button
                            id="key-{{ $tecla }}"
                            class="key-btn bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded px-2 py-3 sm:px-3 sm:py-4 font-bold text-xs sm:text-sm uppercase transition-colors"
                            onclick="manejarClickTeclado('{{ $tecla }}')">
                            {{ $tecla }}
                        </button>
                        @endforeach
                    </div>
                    @endforeach
                </div>

                <style>
                    /* Animación de vibración encapsulada */
                    @keyframes shake {

                        0%,
                        100% {
                            transform: translateX(0);
                        }

                        25% {
                            transform: translateX(-5px);
                        }

                        75% {
                            transform: translateX(5px);
                        }
                    }

                    #game-container .shake {
                        animation: shake 0.2s ease-in-out;
                    }

                    /* Colores del teclado */
                    #keyboard .key-correct {
                        background-color: #538d4e !important;
                        color: white !important;
                    }

                    #keyboard .key-present {
                        background-color: #b59f3b !important;
                        color: white !important;
                    }

                    #keyboard .key-absent {
                        background-color: #3a3a3c !important;
                        color: white !important;
                    }

                    /* Botones especiales */
                    #key-ENTER,
                    #key-BORRAR {
                        padding-left: 15px;
                        padding-right: 15px;
                        font-size: 10px;
                    }
                </style>
            </div>
        </div>
    </div>
    <div id="modal-resultados" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm transition-opacity duration-300">
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl max-w-md w-full overflow-hidden transform transition-all scale-95 opacity-0" id="modal-content">
            <div class="p-8 text-center">
                <h2 class="text-3xl font-black text-gray-800 dark:text-white mb-2 uppercase tracking-tighter">¡Prueba Finalizada!</h2>
                <p id="modal-mensaje" class="text-gray-500 dark:text-gray-400 mb-2"></p>
                <p id="palabra-correcta-container" class="hidden mb-6 text-sm font-medium text-gray-400">
                    La palabra era: <span id="res-palabra" class="text-indigo-500 font-bold uppercase"></span>
                </p>

                <div class="grid grid-cols-2 gap-3 mb-4">
                    <div class="bg-gray-50 dark:bg-gray-900/50 p-4 rounded-2xl border border-gray-100 dark:border-gray-700">
                        <p class="text-xs font-bold text-gray-400 uppercase mb-1">Tiempo</p>
                        <p class="text-2xl font-black text-indigo-600"><span id="res-min">0</span></p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-900/50 p-4 rounded-2xl border border-gray-100 dark:border-gray-700">
                        <p class="text-xs font-bold text-gray-400 uppercase mb-1">Intentos</p>
                        <p class="text-2xl font-black text-green-500"><span id="res-intentos">0</span></p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 mb-8">
                    <div class="bg-indigo-600 p-4 rounded-2xl shadow-lg shadow-indigo-200 dark:shadow-none flex flex-col justify-center items-center">
                        <p class="text-white/80 text-[10px] font-bold uppercase mb-1">Puntos Obtenidos</p>
                        <p class="text-white text-3xl font-black" id="res-puntos">0</p>
                    </div>
                    <div class="bg-yellow-500 p-4 rounded-2xl shadow-lg shadow-yellow-100 dark:shadow-none flex flex-col justify-center items-center">
                        <p class="text-yellow-950/80 text-[10px] font-bold uppercase mb-1">Monedas Arcade</p>
                        <p class="text-yellow-950 text-3xl font-black" id="res-coins">+0 🪙</p>
                    </div>
                </div>

                <button onclick="window.location.href='/dashboard'" class="w-full py-4 bg-gray-900 dark:bg-white dark:text-gray-900 text-white font-bold rounded-xl hover:scale-[1.02] transition transform active:scale-95">
                    VOLVER AL DASHBOARD
                </button>
            </div>
        </div>
    </div>
    <script>
        window.csrfToken = "{{ csrf_token() }}";
        window.wordleGameId = 1;
    </script>
    <script src="{{ asset('js/wordle.js') }}"></script>
</x-app-layout>