<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;

class RankingController extends Controller
{
    public function index()
    {

        $rankingDepartamentos = DB::table('departments')
            ->join('users', 'departments.id', '=', 'users.department_id')
            ->join('scores', 'users.id', '=', 'scores.user_id')
            ->select('departments.name', DB::raw('AVG(scores.points) as promedio'))
            ->groupBy('departments.id', 'departments.name')
            ->orderBy('promedio', 'DESC')
            ->get();


        $rankingIndividual = User::join('scores', 'users.id', '=', 'scores.user_id')
            ->join('departments', 'users.department_id', '=', 'departments.id')
            ->select(
                'users.name', 
                'users.avatar', 
                'users.frame_id',
                'departments.name as depto', 
                DB::raw('SUM(scores.points) as total_puntos')
            )
            ->groupBy('users.id', 'users.name', 'users.avatar', 'users.frame_id', 'departments.name')
            ->orderBy('total_puntos', 'DESC')
            ->limit(10)
            ->get();

        return view('ranking', compact('rankingDepartamentos', 'rankingIndividual'));
    }
}