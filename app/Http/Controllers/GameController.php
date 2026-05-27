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


            $user = Auth::user();
            $gameId = $request->game_id;
            $points = $request->points;
            $coinsEarned = 0;


            if ($points > 0) {
                switch ($gameId) {
                    case 1: // WORDLE
                        // Si gana en el intento 1 son 500p -> 200 coins. Si gana en el 6 son 100p -> 40 coins.
                        $coinsEarned = max(10, round($points * 0.4)); 
                        break;

                    case 2: // TYPESPEED
                        $coinsEarned = max(10, round($points * 0.35));
                        break;

                    case 3: // BOMBPARTY
                        // Otorgamos un 25% de la puntuación total en monedas
                        $coinsEarned = max(10, round($points * 0.25));
                        break;
                    
                    default:
                        $coinsEarned = max(5, round($points * 0.1));
                        break;
                }
            }

            $user->coins += $coinsEarned;
            $user->save();

            return response()->json([
                'success' => true,
                'coins_earned' => $coinsEarned
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function wordle()
    {
        $yaJugo = Score::where('user_id', Auth::id())
            ->where('game_id', 1)
            ->whereDate('created_at', now()->toDateString())
            ->exists();

        if ($yaJugo) {
            return redirect()->route('dashboard')->with('status', 'Ya has jugado al Wordle hoy.');
        }

        return view('juegos.wordle');
    }

    public function typeSpeed()
    {
        $yaJugo = Score::where('user_id', Auth::id())
            ->where('game_id', 2) 
            ->whereDate('created_at', now()->toDateString())
            ->exists();

        if ($yaJugo) {
            return redirect()->route('dashboard')->with('status', 'Ya has jugado al TypeSpeed hoy.');
        }

        return view('juegos.typespeed');
    }

    public function bombParty()
    {
        $yaJugo = Score::where('user_id', Auth::id())
            ->where('game_id', 3) 
            ->whereDate('created_at', now()->toDateString())
            ->exists();

        if ($yaJugo) {
            return redirect()->route('dashboard')->with('status', 'Ya has jugado al BombParty hoy.');
        }

        return view('juegos.bombparty');
    }
}