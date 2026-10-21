<?php

use App\Models\Frame;
use App\Models\Game;
use App\Models\Score;
use App\Models\User;

beforeEach(function () {
    // Los juegos son FK de scores; forceCreate porque 'slug' no está en $fillable
    Game::forceCreate(['id' => 1, 'name' => 'Wordle', 'slug' => 'wordle']);
    Game::forceCreate(['id' => 2, 'name' => 'TypeSpeed', 'slug' => 'typespeed']);
    Game::forceCreate(['id' => 3, 'name' => 'BombParty', 'slug' => 'bombparty']);
});

it('exige autenticación para guardar puntuaciones', function () {
    $this->postJson('/juegos/save-score', ['game_id' => 1, 'points' => 100])
        ->assertUnauthorized();

    expect(Score::count())->toBe(0);
});

it('guarda la puntuación y concede monedas', function () {
    $user = User::factory()->create(['coins' => 0]);

    $this->actingAs($user)
        ->postJson('/juegos/save-score', ['game_id' => 1, 'points' => 500, 'time_taken' => 90])
        ->assertOk()
        ->assertJson(['success' => true, 'coins_earned' => 200]);

    expect(Score::where('user_id', $user->id)->where('points', 500)->exists())->toBeTrue();
    expect($user->fresh()->coins)->toBe(200);
});

it('rechaza puntuaciones negativas o fuera de rango', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->postJson('/juegos/save-score', ['game_id' => 1, 'points' => -50])
        ->assertUnprocessable();

    $this->actingAs($user)
        ->postJson('/juegos/save-score', ['game_id' => 1, 'points' => 999999])
        ->assertUnprocessable();

    expect(Score::count())->toBe(0);
});

it('rechaza un juego inexistente', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->postJson('/juegos/save-score', ['game_id' => 99, 'points' => 100])
        ->assertUnprocessable();
});

it('impide guardar dos partidas del mismo juego el mismo día', function () {
    $user = User::factory()->create(['coins' => 0]);

    $this->actingAs($user)->postJson('/juegos/save-score', ['game_id' => 2, 'points' => 300]);

    $this->actingAs($user)
        ->postJson('/juegos/save-score', ['game_id' => 2, 'points' => 300])
        ->assertStatus(409);

    expect(Score::where('user_id', $user->id)->count())->toBe(1);
    expect($user->fresh()->coins)->toBe(105);
});

it('compra un marco descontando monedas', function () {
    $user = User::factory()->create(['coins' => 1000]);
    $frame = Frame::create(['name' => 'Test', 'image_path' => 'frames/t.png', 'price' => 400]);

    $this->actingAs($user)
        ->post("/tienda/comprar/{$frame->id}")
        ->assertSessionHas('success');

    expect($user->fresh()->coins)->toBe(600);
    expect($user->frames()->where('frame_id', $frame->id)->exists())->toBeTrue();
});

it('no permite comprar un marco sin monedas suficientes', function () {
    $user = User::factory()->create(['coins' => 100]);
    $frame = Frame::create(['name' => 'Caro', 'image_path' => 'frames/c.png', 'price' => 400]);

    $this->actingAs($user)
        ->post("/tienda/comprar/{$frame->id}")
        ->assertSessionHas('error');

    expect($user->fresh()->coins)->toBe(100);
    expect($user->frames()->count())->toBe(0);
});

it('no permite comprar dos veces el mismo marco', function () {
    $user = User::factory()->create(['coins' => 1000]);
    $frame = Frame::create(['name' => 'Unico', 'image_path' => 'frames/u.png', 'price' => 300]);

    $this->actingAs($user)->post("/tienda/comprar/{$frame->id}");
    $this->actingAs($user)
        ->post("/tienda/comprar/{$frame->id}")
        ->assertSessionHas('error');

    expect($user->fresh()->coins)->toBe(700);
    expect($user->frames()->count())->toBe(1);
});
