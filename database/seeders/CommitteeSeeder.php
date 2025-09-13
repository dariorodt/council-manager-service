<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommitteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $committees = [
            'Comité de Servicios Públicos',
            'Comité de Salud y Prevención Comunitaria',
            'Comité de Educación y Cultura',
            'Comité de Seguridad y Protección Civil',
            'Comité de Infraestructura y Vialidad',
            'Comité de Juventud y Deporte',
            'Comité de Economía Popular y Producción',
            'Comité de Ambiente y Reciclaje',
            'Comité de Atención a Personas con Discapacidad y Adultos Mayores',
            'Comité de Comunicación y Medios Comunitarios'
        ];

        foreach ($committees as $index => $name) {
            \App\Models\Committee::create([
                'name' => $name,
                'responsible_id' => ($index % 20) + 1, // Assign members 1-20 as responsibles
                'status' => 'En Funciones',
                'creation_date' => '2025-01-01',
            ]);
        }
    }
}
