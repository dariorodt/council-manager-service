<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $committees = \App\Models\Committee::all();
        
        if ($committees->isEmpty()) {
            $this->command->warn('No committees found. Please run CommitteeSeeder first.');
            return;
        }

        $projects = [
            [
                'committee_id' => $committees[0]->id ?? 1,
                'function_id' => null,
                'name' => 'Mejoramiento del Sistema de Agua Potable',
                'description' => 'Proyecto para mejorar la distribución y calidad del agua potable en la comunidad mediante la instalación de nuevas tuberías y sistemas de filtración.',
                'status' => 'en_ejecucion',
                'planned_start' => '2025-01-15',
                'real_start' => '2025-01-20',
                'planned_end' => '2025-06-15',
                'duration' => '150',
                'advance' => 35.50
            ],
            [
                'committee_id' => $committees[1]->id ?? 2,
                'function_id' => null,
                'name' => 'Campaña de Vacunación Comunitaria',
                'description' => 'Organización de jornadas de vacunación para niños y adultos mayores en coordinación con el Ministerio de Salud.',
                'status' => 'completado',
                'planned_start' => '2024-11-01',
                'real_start' => '2024-11-01',
                'planned_end' => '2024-12-31',
                'real_end' => '2024-12-28',
                'duration' => '60',
                'advance' => 100.00
            ],
            [
                'committee_id' => $committees[2]->id ?? 3,
                'function_id' => null,
                'name' => 'Biblioteca Comunitaria Digital',
                'description' => 'Creación de un espacio de lectura y estudio equipado con computadoras y acceso a internet para la comunidad.',
                'status' => 'programado',
                'planned_start' => '2025-03-01',
                'planned_end' => '2025-08-31',
                'duration' => '180',
                'advance' => 0.00
            ],
            [
                'committee_id' => $committees[3]->id ?? 4,
                'function_id' => null,
                'name' => 'Sistema de Vigilancia Comunitaria',
                'description' => 'Implementación de un sistema de cámaras de seguridad y organización de rondas vecinales para mejorar la seguridad.',
                'status' => 'en_ejecucion',
                'planned_start' => '2024-12-01',
                'real_start' => '2024-12-05',
                'planned_end' => '2025-04-30',
                'duration' => '120',
                'advance' => 60.75
            ],
            [
                'committee_id' => $committees[4]->id ?? 5,
                'function_id' => null,
                'name' => 'Asfaltado de Calles Principales',
                'description' => 'Proyecto de asfaltado y señalización de las calles principales de la comunidad para mejorar la movilidad.',
                'status' => 'en_ejecucion',
                'planned_start' => '2025-02-01',
                'real_start' => '2025-02-10',
                'planned_end' => '2025-07-31',
                'duration' => '180',
                'advance' => 25.00
            ],
            [
                'committee_id' => $committees[5]->id ?? 6,
                'function_id' => null,
                'name' => 'Cancha Deportiva Multiusos',
                'description' => 'Construcción de una cancha deportiva para fútbol, baloncesto y voleibol con iluminación nocturna.',
                'status' => 'programado',
                'planned_start' => '2025-04-01',
                'planned_end' => '2025-10-31',
                'duration' => '210',
                'advance' => 0.00
            ],
            [
                'committee_id' => $committees[6]->id ?? 7,
                'function_id' => null,
                'name' => 'Mercado Comunitario',
                'description' => 'Establecimiento de un mercado comunitario para promover la venta de productos locales y el comercio justo.',
                'status' => 'en_ejecucion',
                'planned_start' => '2024-10-01',
                'real_start' => '2024-10-15',
                'planned_end' => '2025-03-31',
                'duration' => '180',
                'advance' => 70.25
            ],
            [
                'committee_id' => $committees[7]->id ?? 8,
                'function_id' => null,
                'name' => 'Programa de Reciclaje Comunitario',
                'description' => 'Implementación de un sistema de recolección selectiva de residuos y educación ambiental para la comunidad.',
                'status' => 'completado',
                'planned_start' => '2024-08-01',
                'real_start' => '2024-08-01',
                'planned_end' => '2024-12-31',
                'real_end' => '2024-12-20',
                'duration' => '150',
                'advance' => 100.00
            ]
        ];

        foreach ($projects as $project) {
            \App\Models\Project::create($project);
        }
    }
}
