<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        // Primero nos aseguramos de que la columna sea nullable y del tipo correcto
        $table->unsignedBigInteger('frame_id')->nullable()->change();
        
        // Luego añadimos la restricción
        $table->foreign('frame_id')
              ->references('id')
              ->on('frames')
              ->onDelete('set null');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users_frame', function (Blueprint $table) {
            //
        });
    }
};
