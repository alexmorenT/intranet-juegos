<x-app-layout>
    <div class="py-12 px-4">
        <div class="max-w-5xl mx-auto">
            <div class="mb-10 bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-8 text-white shadow-xl relative overflow-hidden">
                <div class="relative z-10">
                    <h1 class="text-3xl font-bold mb-2">Mis Estadísticas</h1>
                </div>
                <div class="absolute right-[-20px] bottom-[-20px] text-[120px] opacity-20 pointer-events-none"></div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
                <div class="bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-sm border dark:border-gray-700 text-center">
                    <p class="text-gray-500 text-xs uppercase font-bold">Wordle</p>
                    <p class="text-xl font-black text-emerald-500">{{ $stats[1]->max_score ?? 0 }}</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-sm border dark:border-gray-700 text-center">
                    <p class="text-gray-500 text-xs uppercase font-bold">TypeSpeed</p>
                    <p class="text-xl font-black text-indigo-600">{{ $stats[2]->max_score ?? 0 }}</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-sm border dark:border-gray-700 text-center">
                    <p class="text-gray-500 text-xs uppercase font-bold">Bomb Party</p>
                    <p class="text-xl font-black text-red-600">{{ $stats[3]->max_score ?? 0 }}</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-sm border dark:border-gray-700 text-center">
                    <p class="text-gray-500 text-xs uppercase font-bold">Puntos 7d</p>
                    <p class="text-xl font-black text-orange-500">{{ number_format($evolucion->sum('daily_points')) }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-3xl shadow-sm border dark:border-gray-700">
                    <h3 class="text-sm font-bold text-gray-400 uppercase mb-4 tracking-widest text-center">Perfil de Habilidades</h3>
                    <div class="h-[300px]">
                        <canvas id="radarChart"></canvas>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-3xl shadow-sm border dark:border-gray-700">
                    <h3 class="text-sm font-bold text-gray-400 uppercase mb-4 tracking-widest text-center">Evolución Semanal</h3>
                    <div class="h-[300px]">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    window.statsData = {
        // Wordle: 600 pts es el 100% de la barra
        wordleAvg: {{ ($stats[1]->avg_score ?? 0) / 6 }},
        
        // TypeSpeed: ~140 WPM (700 pts) es el 100% de la barra
        typeSpeedAvg: {{ ($stats[2]->avg_score ?? 0) / 7 }}, 
        
        // BombParty: 1200 pts es el 100% de la barra
        bombPartyAvg: {{ ($stats[3]->avg_score ?? 0) / 12 }}, 
        
        // Medias Globales (Mismos divisores para que la comparación sea justa)
        globalWordleAvg: {{ ($globalStats[1]->global_avg ?? 0) / 6 }},
        globalTypeAvg: {{ ($globalStats[2]->global_avg ?? 0) / 7 }},
        globalBombAvg: {{ ($globalStats[3]->global_avg ?? 0) / 12 }},

        evolucionFechas: @json($evolucion->pluck('date')),
        evolucionPuntos: @json($evolucion->pluck('daily_points'))
    };
</script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/stats.js') }}"></script>
</x-app-layout>