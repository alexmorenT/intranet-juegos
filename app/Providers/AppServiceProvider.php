<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // if (config('app.env') === 'production') {
        //     \Illuminate\Support\Facades\URL::forceScheme('https');
        // }

        // Correo de recuperación de contraseña en español
        ResetPassword::toMailUsing(function ($notifiable, string $token) {
            $url = route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ]);

            return (new MailMessage)
                ->subject('Restablecer tu contraseña - Intranet Arcade')
                ->greeting('Hola, '.$notifiable->name.'.')
                ->line('Has recibido este correo porque hemos recibido una solicitud para restablecer la contraseña de tu cuenta.')
                ->action('Restablecer contraseña', $url)
                ->line('Este enlace caducará en '.config('auth.passwords.users.expire').' minutos.')
                ->line('Si no solicitaste este cambio, no tienes que hacer nada más.');
        });
    }
}
