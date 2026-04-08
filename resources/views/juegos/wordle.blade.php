<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-3xl p-8 border border-gray-100 dark:border-gray-700">

                <h1 class="text-3xl font-black text-center mb-8 text-gray-800 dark:text-white uppercase tracking-tighter">
                    Palabra del Día
                </h1>

                <style>
                    .blocks {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        gap: 8px;
                        height: 75px;
                        margin-bottom: 8px;
                        background: transparent;
                        /* Quitamos el gris oscuro de tu original */
                    }

                    .block {
                        display: inline-block;
                        height: 65px;
                        width: 65px;
                        border: 2px solid #d1d5db;
                        /* Gris suave */
                        border-radius: 12px;
                        text-align: center;
                        font-size: 32px;
                        font-weight: bold;
                        color: #1f2937;
                        background-color: white;
                        text-transform: uppercase;
                        transition: all 0.2s;
                    }

                    /* Soporte para modo oscuro */
                    .dark .block {
                        background-color: #374151;
                        border-color: #4b5563;
                        color: white;
                    }

                    .block:focus {
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
                    /* Animación de vibración para palabras no encontradas */
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

                    .shake {
                        animation: shake 0.4s ease-in-out;
                    }

                    /* Colores del teclado */
                    .key-correct {
                        background-color: #538d4e !important;
                        color: white !important;
                    }

                    .key-present {
                        background-color: #b59f3b !important;
                        color: white !important;
                    }

                    .key-absent {
                        background-color: #3a3a3c !important;
                        color: white !important;
                    }

                    /* Botones especiales más anchos */
                    #key-ENTER,
                    #key-BORRAR {
                        padding-left: 15px;
                        padding-right: 15px;
                        font-size: 10px;
                    }
                </style>

                <div class="mt-8 text-center text-gray-500 dark:text-gray-400 text-sm italic">
                    Escribe una letra y pulsa ENTER al terminar la fila
                </div>
                <div class="text-center mb-4">
                    <span id="timer-display" class="font-mono text-xl text-indigo-600 dark:text-indigo-400">00:00</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.csrfToken = "{{ csrf_token() }}";
        window.wordleGameId = 1;
    </script>
    <script src="{{ asset('js/wordle.js') }}"></script>
</x-app-layout>