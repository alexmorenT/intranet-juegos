<x-app-layout>
    <div class="py-12 px-4">
        <div class="max-w-5xl mx-auto">

            <div class="mb-10 bg-white dark:bg-gray-800 rounded-lg p-8 border border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Tienda</h1>
                </div>
                <div class="bg-gray-50 dark:bg-gray-900/50 px-6 py-3 rounded-md border border-gray-200 dark:border-gray-700 text-center min-w-[150px]">
                    <p class="text-[10px] uppercase tracking-widest opacity-80 text-gray-400 font-bold">Tu Saldo</p>
                    <p class="text-2xl font-black text-amber-500 font-mono mt-0.5">{{ number_format(auth()->user()->coins ?? 0) }} <span class="text-sm">🪙</span></p>
                </div>
            </div>

            @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-md font-medium text-sm">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-md font-medium text-sm">
                {{ session('error') }}
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($frames as $frame)
                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6 flex flex-col items-center transition-all hover:border-gray-300 dark:hover:border-gray-600">

                    <div class="relative mb-6">
                        <div class="w-32 h-32 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center overflow-hidden border-4 border-gray-200 dark:border-gray-600">
                            @if($frame->image_path)
                            <img src="{{ asset('storage/' . $frame->image_path) }}" class="w-full h-full object-cover">
                            @else
                            <span class="text-4xl">👤</span>
                            @endif
                        </div>
                        <div class="absolute -bottom-2 -right-2 bg-yellow-400 text-yellow-900 font-black text-xs px-3 py-1 rounded-md shadow-sm border-2 border-white dark:border-gray-800">
                            {{ $frame->price }} 🪙
                        </div>
                    </div>

                    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-2 uppercase tracking-tight text-center">
                        {{ $frame->name }}
                    </h3>

                    <p class="text-sm text-gray-500 dark:text-gray-400 text-center mb-6 h-10 overflow-hidden">
                        {{ $frame->description }}
                    </p>

                    <form action="{{ route('tienda.comprar', $frame->id) }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md font-bold uppercase text-xs tracking-widest transition-colors shadow-sm">
                            Adquirir ahora
                        </button>
                    </form>
                </div>
                @endforeach
            </div>

            @if($frames->isEmpty())
            <div class="text-center py-20 bg-white dark:bg-gray-800 rounded-lg border border-dashed border-gray-300 dark:border-gray-700 mt-8">
                <p class="text-gray-400 italic">La tienda está vacía por ahora. ¡Vuelve pronto!</p>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>