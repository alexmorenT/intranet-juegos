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
        // Creamos un departamento
        $depto = \App\Models\Department::create([
            'name' => 'Desarrollo'
        ]);

        //  Creamos un usuario y lo asignamos al departamento
        $user = \App\Models\User::create([
            'name' => 'Jugador Uno',
            'email' => 'test@example.com',
            'password' => bcrypt('password'), // Siempre encriptada
            'department_id' => $depto->id,    // Usamos la relación
        ]);

        //  Creamos un juego
        $game = \App\Models\Game::create([
            'name' => 'Wordle',
            'slug' => 'wordle',
            'description' => 'Adivina la palabra en 6 intentos'
        ]);
    }
}
