<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveScoreRequest;
use App\Models\Score;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GameController extends Controller
{
    public function saveScore(SaveScoreRequest $request)
    {
        $gameId = $request->integer('game_id');
        $points = $request->integer('points');
        $timeTaken = $request->integer('time_taken');

        try {
            $coinsEarned = DB::transaction(function () use ($gameId, $points, $timeTaken) {
                // Bloqueo de la fila del usuario: serializa peticiones concurrentes para que el límite diario no se salte
                $user = User::whereKey(Auth::id())->lockForUpdate()->firstOrFail();

                $yaJugo = Score::where('user_id', $user->id)
                    ->where('game_id', $gameId)
                    ->whereDate('created_at', now()->toDateString())
                    ->exists();

                if ($yaJugo) {
                    return null;
                }

                Score::create([
                    'user_id' => $user->id,
                    'game_id' => $gameId,
                    'points' => $points,
                    'time_taken' => $timeTaken,
                ]);

                $coins = $this->coinsFor($gameId, $points);

                // increment() genera un UPDATE atómico (coins = coins + n), sin leer-modificar-escribir en PHP
                $user->increment('coins', $coins);

                return $coins;
            });

            if ($coinsEarned === null) {
                return response()->json(['error' => 'Ya has guardado una partida de este juego hoy.'], 409);
            }

            return response()->json([
                'success' => true,
                'coins_earned' => $coinsEarned,
            ]);

        } catch (\Throwable $e) {
            Log::error('Error guardando puntuación', ['user_id' => Auth::id(), 'game_id' => $gameId, 'exception' => $e]);

            return response()->json(['error' => 'No se pudo guardar la puntuación.'], 500);
        }
    }

    private function coinsFor(int $gameId, int $points): int
    {
        if ($points <= 0) {
            return 0;
        }

        return match ($gameId) {
            // WORDLE: si gana en el intento 1 son 500p -> 200 coins. Si gana en el 6 son 100p -> 40 coins.
            1 => (int) max(10, round($points * 0.4)),
            // TYPESPEED
            2 => (int) max(10, round($points * 0.35)),
            // BOMBPARTY: 25% de la puntuación total en monedas
            3 => (int) max(10, round($points * 0.25)),
            default => (int) max(5, round($points * 0.1)),
        };
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
