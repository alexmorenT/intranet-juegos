<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;

class RankingController extends Controller
{
    public function index()
    {
        // 1. Ranking por Departamentos (Promedio de puntos de sus miembros)
        $rankingDepartamentos = DB::table('departments')
            ->join('users', 'departments.id', '=', 'users.department_id')
            ->join('scores', 'users.id', '=', 'scores.user_id')
            ->select('departments.name', DB::raw('AVG(scores.points) as promedio'))
            ->groupBy('departments.id', 'departments.name')
            ->orderBy('promedio', 'DESC')
            ->get();

        // 2. Ranking Individual (Top 10 jugadores por puntos totales)
        $rankingIndividual = User::join('scores', 'users.id', '=', 'scores.user_id')
            ->join('departments', 'users.department_id', '=', 'departments.id')
            ->select('users.name', 'departments.name as depto', DB::raw('SUM(scores.points) as total_puntos'))
            ->groupBy('users.id', 'users.name', 'departments.name')
            ->orderBy('total_puntos', 'DESC')
            ->limit(10)
            ->get();

        return view('ranking', compact('rankingDepartamentos', 'rankingIndividual'));
    }
}