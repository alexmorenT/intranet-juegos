<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Información del Perfil') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Actualiza la información de tu cuenta, tu foto de perfil y personaliza tu marco.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- IMPORTANTE: Se añade enctype="multipart/form-data" para la subida de archivos --}}
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="flex items-center space-x-6 p-4 bg-gray-50 dark:bg-gray-800/50 rounded-2xl border border-dashed border-gray-300 dark:border-gray-700">
            <div class="relative">
                <div class="relative h-24 w-24">
                    @if(Auth::user()->frame_id > 0)
                        <img src="{{ asset('storage/frames/frame-' . Auth::user()->frame_id . '.png') }}" 
                             class="absolute inset-0 z-10 h-full w-full object-contain scale-110 pointer-events-none" 
                             alt="Marco equipado">
                    @endif

                    <div class="h-full w-full rounded-full overflow-hidden bg-indigo-500 flex items-center justify-center shadow-inner">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" class="h-full w-full object-cover">
                        @else
                            <span class="text-3xl font-bold text-white">{{ substr($user->name, 0, 1) }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex-1">
                <x-input-label for="avatar" :value="__('Foto de Perfil')" />
                <input id="avatar" name="avatar" type="file" 
                       class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition" />
                <p class="text-xs text-gray-500 mt-1">Recomendado: JPG o PNG (Máx. 2MB)</p>
                <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="name" :value="__('Nombre de Usuario')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Correo Electrónico')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                            {{ __('Tu dirección de correo no está verificada.') }}
                            <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none">
                                {{ __('Haz clic aquí para re-enviar el email de verificación.') }}
                            </button>
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-4">
            <x-input-label :value="__('Marcos Desbloqueados')" />
            <div class="grid grid-cols-4 sm:grid-cols-6 gap-3 mt-2">
                <label class="relative cursor-pointer group">
                    <input type="radio" name="frame_id" value="0" {{ $user->frame_id == 0 ? 'checked' : '' }} class="peer sr-only">
                    <div class="p-2 border-2 border-transparent rounded-xl peer-checked:border-indigo-500 peer-checked:bg-indigo-50 dark:peer-checked:bg-indigo-900/20 transition">
                        <div class="h-12 w-12 rounded-full border-2 border-dashed border-gray-300 flex items-center justify-center text-[10px] text-gray-400">
                            Sin Marco
                        </div>
                    </div>
                </label>

                {{-- Aquí iría un @foreach con los marcos que el usuario ha comprado en la tienda --}}
                {{-- Por ahora lo dejamos listo para el futuro --}}
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4 border-t dark:border-gray-700">
            <x-primary-button>{{ __('Guardar Cambios') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('¡Perfil actualizado con éxito!') }}
                </p>
            @endif
        </div>
    </form>
</section>