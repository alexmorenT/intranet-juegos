<x-app-layout>
    <div class="py-12 px-4">
        <div class="max-w-5xl mx-auto">
            
            <div class="mb-10 bg-gradient-to-r from-yellow-500 to-orange-600 rounded-3xl p-8 text-white shadow-xl relative overflow-hidden">
                <div class="relative z-10">
                    <h1 class="text-3xl font-bold mb-2">Ranking</h1>
                </div>
                <div class="absolute right-[-20px] bottom-[-20px] text-[120px] opacity-20 pointer-events-none"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border dark:border-gray-700 p-6">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-6 uppercase tracking-widest text-center"> Ranking de Deptos</h3>
                    
                    <div class="space-y-4">
                        @foreach($rankingDepartamentos as $index => $depto)
                        <div class="flex items-center justify-between p-4 {{ $index == 0 ? 'bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200' : 'bg-gray-50 dark:bg-gray-700/50' }} rounded-2xl">
                            <div class="flex items-center">
                                <span class="text-2xl mr-4">{{ $index == 0 ? '🥇' : ($index == 1 ? '🥈' : ($index == 2 ? '🥉' : $index + 1)) }}</span>
                                <span class="font-bold text-gray-700 dark:text-gray-200">{{ $depto->name }}</span>
                            </div>
                            <span class="font-black text-orange-500">{{ round($depto->promedio) }} pts</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border dark:border-gray-700 p-6">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-6 uppercase tracking-widest text-center"> Top 10 Individual </h3>
                    
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-gray-400 border-b dark:border-gray-700">
                                <th class="pb-3 text-left">Jugador</th>
                                <th class="pb-3 text-right">Puntos</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y dark:divide-gray-700">
                            @foreach($rankingIndividual as $user)
                            <tr>
                                <td class="py-4">
                                    <p class="font-bold text-gray-700 dark:text-gray-200">{{ $user->name }}</p>
                                    <p class="text-[10px] text-gray-400 uppercase">{{ $user->depto }}</p>
                                </td>
                                <td class="py-4 text-right font-black text-indigo-500">
                                    {{ number_format($user->total_puntos) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>