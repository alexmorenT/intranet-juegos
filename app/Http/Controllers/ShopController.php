<?php

namespace App\Http\Controllers;

use App\Models\Frame;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index()
    {
        $frames = Frame::all();

        return view('tienda', compact('frames'));
    }

    public function buyFrame($id)
    {
        $frame = Frame::findOrFail($id);

        return DB::transaction(function () use ($frame) {
            // Bloqueo de la fila del usuario: dos compras simultáneas no pueden leer el mismo saldo
            $user = User::whereKey(Auth::id())->lockForUpdate()->firstOrFail();

            if ($user->frames()->where('frame_id', $frame->id)->exists()) {
                return redirect()->back()->with('error', '¡Ya has adquirido este marco anteriormente!');
            }

            if ($user->coins < $frame->price) {
                return redirect()->back()->with('error', '¡No tienes suficientes Arcade Coins!');
            }

            $user->decrement('coins', $frame->price);
            $user->frames()->attach($frame->id);

            return redirect()->back()->with('success', "¡Has adquirido el {$frame->name} correctamente!");
        });
    }
}
