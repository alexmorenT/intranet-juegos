<x-app-layout>
    <div class="py-12 px-4 max-w-6xl mx-auto">

        <div class="mb-10 bg-white dark:bg-gray-800 rounded-lg p-8 border border-gray-200 dark:border-gray-700">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Ranking</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-6 uppercase tracking-widest text-center">Ranking de Deptos</h3>

                <div class="space-y-4">
                    @foreach($rankingDepartamentos as $index => $depto)
                    <div class="flex items-center justify-between p-4 {{ $index == 0 ? 'bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200' : 'bg-gray-50 dark:bg-gray-700/50 border border-transparent' }} rounded-md">
                        <div class="flex items-center">
                            <div class="w-8 h-8 flex items-center justify-center rounded-full mr-4 font-black text-sm
                                {{ $index == 0 ? 'bg-yellow-400 text-yellow-950' : '' }}
                                {{ $index == 1 ? 'bg-slate-300 text-slate-900' : '' }}
                                {{ $index == 2 ? 'bg-amber-600 text-amber-50' : '' }}
                                {{ $index > 2 ? 'text-gray-400 dark:text-gray-500' : '' }}">
                                {{ $index + 1 }}
                            </div>

                            <span class="font-bold text-gray-700 dark:text-gray-200">{{ $depto->name }}</span>
                        </div>
                        <span class="font-black text-orange-500 font-mono">{{ round($depto->promedio) }} pts</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-6 uppercase tracking-widest text-center">Top 10 Individual</h3>

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
                            <td class="py-3 flex items-center space-x-4">
                                <div class="relative h-12 w-12 flex-shrink-0">
                                    @if($user->frame_id > 0)
                                        <img src="{{ asset('storage/frames/frame-' . $user->frame_id . '.png') }}" 
                                             class="absolute inset-0 z-10 h-full w-full object-contain scale-150 pointer-events-none" 
                                             alt="Marco">
                                    @endif

                                    @if($user->avatar)
                                        <img src="{{ asset('storage/' . $user->avatar) }}" 
                                             class="h-full w-full rounded-full object-cover z-0" 
                                             alt="Avatar">
                                    @else
                                        <div class="h-full w-full rounded-full bg-indigo-100 dark:bg-indigo-950/50 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold uppercase text-xs z-0">
                                            {{ substr($user->name, 0, 2) }}
                                        </div>
                                    @endif
                                </div>

                                <div>
                                    <p class="font-bold text-gray-700 dark:text-gray-200 leading-tight">{{ $user->name }}</p>
                                    <p class="text-[10px] text-gray-400 uppercase tracking-wider mt-0.5">{{ $user->depto }}</p>
                                </div>
                            </td>
                            <td class="py-3 text-right font-black text-indigo-500 font-mono align-middle">
                                {{ number_format($user->total_puntos) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>