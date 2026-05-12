<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Columna para la ruta de la foto de perfil (puede ser nula)
            $table->string('avatar')->nullable()->after('email');
            
            // Por ahora por defecto es 0 (sin marco)
            $table->unsignedBigInteger('frame_id')->default(0)->after('avatar');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['avatar', 'frame_id']);
        });
    }
};