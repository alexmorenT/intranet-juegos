<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['name', 'description'];

    public function scores()
    {
        // Un juego tiene muchas puntuaciones
        return $this->hasMany(Score::class);
    }
}
