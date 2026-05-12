<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Frame;

class FrameSeeder extends Seeder
{
public function run(): void
    {
        $marcos = [
            [
                'name' => 'Novato de Bronce',
                'image_path' => 'frames/frame-1.png',
                'price' => 0, // Gratis para empezar
                'description' => 'El marco estándar para los nuevos reclutas del Arcade.'
            ],
            [
                'name' => 'Fuego Infernal',
                'image_path' => 'frames/frame-2.png',
                'price' => 500,
                'description' => 'Solo para aquellos que dominan el BombParty con pasión.'
            ]
        ];

        foreach ($marcos as $marco) {
            Frame::create($marco);
        }
    }
}
