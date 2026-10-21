<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Envía un correo de prueba con Mailtrap: php artisan send-mail destino@correo.com
Artisan::command('send-mail {to : Dirección de correo de destino}', function () {
    $to = $this->argument('to');

    Mail::raw('¡Felicidades! Este es un correo de prueba enviado con Mailtrap desde Intranet Arcade.', function ($message) use ($to) {
        $message->to($to)->subject('Prueba de envío - Intranet Arcade');
    });

    $this->info("Correo enviado a {$to}.");
})->purpose('Send a test email with Mailtrap');
