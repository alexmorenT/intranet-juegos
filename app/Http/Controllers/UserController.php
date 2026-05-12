<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Score;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;
        $deptId = $user->department_id;

        // 1. Puntos totales del usuario
        $puntosTotales = Score::where('user_id', $userId)->sum('points');

        // 2. Juegos hechos hoy
        $juegosHoy = Score::where('user_id', $userId)->whereDate('created_at', today())->count();

        // 3. CÁLCULO DE POSICIÓN REAL EN EL DEPARTAMENTO
        $rankingDepto = DB::table('users')
            ->leftJoin('scores', 'users.id', '=', 'scores.user_id')
            ->select('users.id', DB::raw('SUM(IFNULL(scores.points, 0)) as total_points'))
            ->where('users.department_id', $deptId)
            ->groupBy('users.id')
            ->orderBy('total_points', 'DESC')
            ->get();

        // Buscamos el índice del usuario actual en la colección (empezando en 0, por eso sumamos 1)
        $indice = $rankingDepto->search(fn($item) => $item->id == $userId);
        $posicion = ($indice !== false) ? $indice + 1 : '-';

        // 4. CÁLCULO DE LA RACHA (Días consecutivos jugando)
        $racha = 0;
        $fechasJugadas = Score::where('user_id', $userId)
            ->select(DB::raw('DATE(created_at) as date'))
            ->distinct()
            ->orderBy('date', 'DESC')
            ->pluck('date')
            ->toArray();

        if (!empty($fechasJugadas)) {
            $fechaEsperada = \Carbon\Carbon::today();
            
            // Si no ha jugado hoy, comprobamos si la racha se mantiene desde ayer
            if ($fechasJugadas[0] != $fechaEsperada->format('Y-m-d')) {
                $fechaEsperada->subDay();
            }

            foreach ($fechasJugadas as $fecha) {
                if ($fecha == $fechaEsperada->format('Y-m-d')) {
                    $racha++;
                    $fechaEsperada->subDay();
                } else {
                    break;
                }
            }
        }

        // 5. Verificación de juegos diarios
        $yaJugoWordle = Score::where('user_id', $userId)->where('game_id', 1)->whereDate('created_at', today())->exists();
        $yaJugoTypeSpeed = Score::where('user_id', $userId)->where('game_id', 2)->whereDate('created_at', today())->exists();
        $yaJugoBombParty = Score::where('user_id', $userId)->where('game_id', 3)->whereDate('created_at', today())->exists();

        // Miembros totales para el "Ranking #X de Y"
        $totalUsuariosDepto = User::where('department_id', $deptId)->count();

        return view('dashboard', compact(
            'puntosTotales', 
            'posicion', 
            'user', 
            'juegosHoy', 
            'racha',
            'yaJugoWordle', 
            'yaJugoTypeSpeed', 
            'yaJugoBombParty',
            'totalUsuariosDepto'
        ));
    }
}