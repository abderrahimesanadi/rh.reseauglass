<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServicessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            [
                'nom' => 'Verif',
                'couleur' => '#90EE90', // Vert clair
            ],
            [
                'nom' => 'Courrier',
                'couleur' => '#FFFF99', // Jaune clair
            ],
            [
                'nom' => 'Relance',
                'couleur' => '#DDA0DD', // Violet clair
            ],
            [
                'nom' => 'Qualité',
                'couleur' => '#FFA07A', // Orange clair
            ],
            [
                'nom' => 'Recouvrement',
                'couleur' => '#87CEFA', // Bleu clair
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}

