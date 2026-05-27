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
                'name' => 'NOVATO DE ARCADE',
                'image_path' => 'frames/frame-1.png',
                'price' => 0,
                'description' => 'El marco estándar para los nuevos reclutas del Arcade.'
            ],
            [
                'name' => 'JEFE DE ZONA',
                'image_path' => 'frames/frame-2.png',
                'price' => 500,
                'description' => 'Solo para aquellos que dominan el Wordle a la primera.'
            ],
            [
                'name' => 'MECANÓGRAFO PROFESIONAL',
                'image_path' => 'frames/frame-3.png',
                'price' => 1000,
                'description' => 'El marco para los que TypeSpeed es su segundo idioma.'
            ],
            [
                'name' => 'FUEGO INFERNAL',
                'image_path' => 'frames/frame-4.png',
                'price' => 1500,
                'description' => 'Para los que BombParty es un paseo.'
            ],
            [
                'name' => 'DIOS COMPETITIVO',
                'image_path' => 'frames/frame-5.png',
                'price' => 1750,
                'description' => 'Sólo los expertos en todos los juegos pueden obtenerlo.'
            ],
            [
                'name' => 'ESTADÍSTICAS RADIOACTIVAS',
                'image_path' => 'frames/frame-6.png',
                'price' => 2050,
                'description' => 'Exclusivo para los adictos a las estadísticas.'
            ],
            [
                'name' => 'DESIERTO DE MONEDAS',
                'image_path' => 'frames/frame-7.png',
                'price' => 2500,
                'description' => 'Para los que coleccionan monedas en el Arcade.'
            ],
            [
                'name' => 'MAGO DEL ARCADE',
                'image_path' => 'frames/frame-8.png',
                'price' => 2850,
                'description' => 'Quienes dominan el mundo del Arcade.'
            ],
            [
                'name' => 'SUPERESTRELLA',
                'image_path' => 'frames/frame-9.png',
                'price' => 3200,
                'description' => 'Marco para los jugadores estrellas del Arcade.'
            ],
            [
                'name' => 'ESMERALDA CELESTIAL',
                'image_path' => 'frames/frame-10.png',
                'price' => 3750,
                'description' => 'Jugadores que alcanzan la excelencia.'
            ],
            [
                'name' => 'HIELO INCESANTE',
                'image_path' => 'frames/frame-11.png',
                'price' => 4350,
                'description' => 'Para quienes tienen una mente fría y calculadora.'
            ],
            [
                'name' => 'RACHA INFERNAL',
                'image_path' => 'frames/frame-12.png',
                'price' => 4950,
                'description' => 'Si la racha es lo tuyo, este es tu marco.'
            ],
            [
                'name' => 'IMPARABLE',
                'image_path' => 'frames/frame-13.png',
                'price' => 5500,
                'description' => 'Nadie puede detenerte.'
            ],
            [
                'name' => 'BESTIA OCULTA',
                'image_path' => 'frames/frame-14.png',
                'price' => 5950,
                'description' => 'Para los que ocultan su potencial.'
            ],
            [
                'name' => 'ALQUIMISTA',
                'image_path' => 'frames/frame-15.png',
                'price' => 6500,
                'description' => 'Alquimista de los secretos del Arcade.'
            ],
            [
                'name' => 'INVENCIBLE',
                'image_path' => 'frames/frame-16.png',
                'price' => 7000,
                'description' => 'Imposible de vencer.'
            ],
            [
                'name' => 'JEFE PLANETARIO',
                'image_path' => 'frames/frame-17.png',
                'price' => 7500,
                'description' => 'Nadie sabe de donde vienes, pero de este planeta seguro que no.'
            ],
            [
                'name' => 'REY DE LOS JUEGOS',
                'image_path' => 'frames/frame-18.png',
                'price' => 7900,
                'description' => 'Prestigio III'
            ],
            [
                'name' => 'EMPERADOR DEL ARCADE',
                'image_path' => 'frames/frame-19.png',
                'price' => 8450,
                'description' => 'Prestigio II'
            ],
            [
                'name' => 'FINAL BOSS',
                'image_path' => 'frames/frame-20.png',
                'price' => 8900,
                'description' => 'Prestigio I'
            ]
        ];

        foreach ($marcos as $marco) {
            Frame::create($marco);
        }
    }
}
