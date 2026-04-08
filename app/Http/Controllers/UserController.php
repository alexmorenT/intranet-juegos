<?php


// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Score;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Calculamos los datos reales de la BD
        // Si aún no tienes puntuaciones, esto devolverá 0
        $puntosTotales = Score::where('user_id', $user->id)->sum('points');

        // Juegos hechos hoy
        $juegosHoy = Score::where('user_id', $user->id)->whereDate('created_at', today())->count();

        // Ranking (simplificado para que no de error ahora)
        $posicion = 1;

        // Comprobamos si ya existe una puntuación hoy para el juego 1 (Wordle)
        $yaJugoWordle = Score::where('user_id', $user->id)
            ->where('game_id', 1)
            ->whereDate('created_at', today())
            ->exists();

        $yaJugoTypeSpeed = Score::where('user_id', $user->id)
            ->where('game_id', 2)
            ->whereDate('created_at', today())
            ->exists();

        // ESTO ES LO MÁS IMPORTANTE: Pasar las variables a la vista
        return view('dashboard', compact('puntosTotales', 'juegosHoy', 'posicion', 'yaJugoWordle', 'yaJugoTypeSpeed'));
    }
}
