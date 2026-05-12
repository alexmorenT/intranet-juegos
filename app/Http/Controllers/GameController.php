<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{


    public function saveScore(Request $request)
    {
        try {
            Score::create([
                'user_id' => Auth::id(),
                'game_id' => $request->game_id,
                'points' => $request->points,
                'time_taken' => $request->time_taken ?? 0,
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Esto devolverá el error real en lugar de un 500 genérico durante las pruebas
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function wordle()
    {
        // El ID 1 será para Wordle (asegúrate de tenerlo en tu tabla 'games')
        $yaJugo = Score::where('user_id', Auth::id())
            ->where('game_id', 1)
            ->whereDate('created_at', now()->toDateString())
            ->exists();

        if ($yaJugo) {
            return redirect()->route('dashboard')->with('status', 'Ya has jugado al Wordle hoy. ¡Vuelve mañana!');
        }

        return view('juegos.wordle');
    }

    public function typeSpeed()
    {
        $yaJugo = Score::where('user_id', Auth::id())
            ->where('game_id', 2) // Asegúrate de que el ID 2 corresponde a TypeSpeed
            ->whereDate('created_at', now()->toDateString())
            ->exists();
        if ($yaJugo) {
            return redirect()->route('dashboard')->with('status', 'Ya has jugado al TypeSpeed hoy. ¡Vuelve mañana!');
        }
        return view('juegos.typespeed');
    }

    public function bombParty()
    {
        $yaJugo = Score::where('user_id', Auth::id())
            ->where('game_id', 3) // Asegúrate de que el ID 3 corresponde a BombParty
            ->whereDate('created_at', now()->toDateString())
            ->exists();
        if ($yaJugo) {
            return redirect()->route('dashboard')->with('status', 'Ya has jugado al BombParty hoy. ¡Vuelve mañana!');
        }
        return view('juegos.bombparty');
    }
}
