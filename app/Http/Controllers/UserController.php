<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = \App\Models\User::with('department')->get();

        return view('usuarios.index', compact('usuarios'));
    }
}
