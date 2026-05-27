<x-app-layout>
    <div class="py-12 px-4 max-w-6xl mx-auto">
        <div class="mb-10 bg-white dark:bg-gray-800 rounded-lg p-8 border border-gray-200 dark:border-gray-700">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Estadísticas</h1>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-700 text-center shadow-sm">
                <p class="text-gray-500 text-xs uppercase font-bold">Wordle</p>
                <p class="text-xl font-black text-emerald-500 font-mono mt-1">{{ $stats[1]->max_score ?? 0 }}</p>
            </div>

            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-700 text-center shadow-sm">
                <p class="text-gray-500 text-xs uppercase font-bold">TypeSpeed</p>
                <p class="text-xl font-black text-indigo-600 font-mono mt-1">{{ $stats[2]->max_score ?? 0 }}</p>
            </div>

            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-700 text-center shadow-sm">
                <p class="text-gray-500 text-xs uppercase font-bold">Bomb Party</p>
                <p class="text-xl font-black text-red-600 font-mono mt-1">{{ $stats[3]->max_score ?? 0 }}</p>
            </div>

            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-700 text-center shadow-sm">
                <p class="text-gray-500 text-xs uppercase font-bold">Puntos 7d</p>
                <p class="text-xl font-black text-orange-500 font-mono mt-1">{{ number_format($evolucion->sum('daily_points')) }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
                <h3 class="text-sm font-bold text-gray-400 uppercase mb-4 tracking-widest text-center">Perfil de Habilidades</h3>
                <div class="h-[300px]">
                    <canvas id="radarChart"></canvas>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
                <h3 class="text-sm font-bold text-gray-400 uppercase mb-4 tracking-widest text-center">Evolución Semanal</h3>
                <div class="h-[300px]">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
    </div>

<script>
    window.statsData = {
        wordleAvg: {{ ($stats[1]->avg_score ?? 0) / 6 }},
        typeSpeedAvg: {{ ($stats[2]->avg_score ?? 0) / 7 }}, 
        bombPartyAvg: {{ ($stats[3]->avg_score ?? 0) / 12 }}, 
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