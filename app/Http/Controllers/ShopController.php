<?php

namespace App\Http\Controllers;

use App\Models\Frame;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ShopController extends Controller
{
    public function index()
    {
        $frames = Frame::all();
        return view('tienda', compact('frames'));
    }

    public function buyFrame($id)
{
    $user = auth()->user();
    $frame = Frame::findOrFail($id);

    
    if ($user->frames()->where('frame_id', $id)->exists()) {
        return redirect()->back()->with('error', '¡Ya has adquirido este marco anteriormente!');
    }

   
    if ($user->coins < $frame->price) {
        return redirect()->back()->with('error', '¡No tienes suficientes Arcade Coins!');
    }

    
    $user->coins -= $frame->price;
    $user->save();

    
    $user->frames()->attach($frame->id);

    return redirect()->back()->with('success', "¡Has adquirido el {$frame->name} correctamente!");
}
}
