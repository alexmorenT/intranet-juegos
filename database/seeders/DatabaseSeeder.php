<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Creamos un departamento
        $depto = \App\Models\Department::create([
            'name' => 'Desarrollo'
        ]);

        // 2. Creamos un usuario y lo asignamos al departamento
        $user = \App\Models\User::create([
            'name' => 'Jugador Uno',
            'email' => 'test@example.com',
            'password' => bcrypt('password'), // Siempre encriptada
            'department_id' => $depto->id,    // Aquí usamos la relación
        ]);

        // 3. Creamos un juego
        $game = \App\Models\Game::create([
            'name' => 'Wordle',
            'slug' => 'wordle',
            'description' => 'Adivina la palabra en 6 intentos'
        ]);

        // 4. Creamos una puntuación de prueba
        \App\Models\Score::create([
            'user_id' => $user->id,
            'game_id' => $game->id,
            'points' => 90,
            'time_taken' => 45
        ]);
    }
}
