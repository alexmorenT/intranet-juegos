<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score; // Asegúrate de tener el modelo Score
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 1. Récords personales (Máxima puntuación por juego)
        $stats = DB::table('scores')
            ->select('game_id', DB::raw('MAX(points) as max_score'), DB::raw('AVG(points) as avg_score'))
            ->where('user_id', $userId)
            ->groupBy('game_id')
            ->get()
            ->keyBy('game_id');

        // 2. Evolución últimos 7 días
        $evolucion = Score::where('user_id', $userId)
            ->where('created_at', '>=', now()->subDays(7))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(points) as daily_points'))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();
            
        // 3. Media Global de la Empresa (Promedio de todos los registros de la tabla scores)
        $globalStats = DB::table('scores')
            ->select('game_id', DB::raw('AVG(points) as global_avg'))
            ->groupBy('game_id')
            ->get()
            ->keyBy('game_id');

        return view('estadisticas', compact('stats', 'evolucion', 'globalStats'));
    }
}
