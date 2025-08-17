<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Assembly;
use App\Models\Subject;
use App\Models\Resolution;
use App\Models\Attendee;
use Carbon\Carbon;

class AssemblySeeder extends Seeder
{
    public function run(): void
    {
        $types = ['General', 'Extraordinaria', 'De Ciudadanos', 'Informativa'];
        $names = ['Juan Pérez', 'María García', 'Carlos López', 'Ana Martínez', 'Luis Rodríguez', 'Carmen Sánchez'];
        
        // 10 asambleas pasadas
        for ($i = 1; $i <= 10; $i++) {
            $date = Carbon::now()->subMonths(rand(1, 12))->subDays(rand(1, 30));
            $assembly = Assembly::create([
                'correlative' => '2024-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'type' => $types[array_rand($types)],
                'reason' => 'Asamblea para tratar asuntos del período ' . $date->format('M Y'),
                'status' => 'Finalizada',
                'scheduled_date' => $date,
                'actual_date' => $date->copy()->addMinutes(rand(-30, 60))
            ]);
            
            $this->createAssemblyData($assembly, $names);
        }
        
        // 10 asambleas futuras
        for ($i = 11; $i <= 20; $i++) {
            $date = Carbon::now()->addDays(rand(1, 180));
            $assembly = Assembly::create([
                'correlative' => '2025-' . str_pad($i - 10, 3, '0', STR_PAD_LEFT),
                'type' => $types[array_rand($types)],
                'reason' => 'Asamblea programada para ' . $date->format('M Y'),
                'status' => 'Programada',
                'scheduled_date' => $date,
                'actual_date' => null
            ]);
            
            $this->createAssemblyData($assembly, $names);
        }
    }
    
    private function createAssemblyData($assembly, $names)
    {
        // Crear asistentes
        for ($j = 0; $j < rand(5, 12); $j++) {
            Attendee::create([
                'assembly_id' => $assembly->id,
                'name' => $names[array_rand($names)],
                'position' => ['Presidente', 'Secretario', 'Tesorero', 'Vocal', 'Miembro'][array_rand(['Presidente', 'Secretario', 'Tesorero', 'Vocal', 'Miembro'])],
                'is_member' => rand(0, 1),
                'attended' => $assembly->status === 'Finalizada' ? rand(0, 1) : 0
            ]);
        }
        
        // Crear asuntos
        $subjects = [
            'Aprobación del acta anterior',
            'Informe de tesorería',
            'Elección de comité electoral',
            'Aprobación del presupuesto',
            'Modificación de estatutos',
            'Planificación de actividades'
        ];
        
        for ($j = 0; $j < rand(2, 4); $j++) {
            $subject = Subject::create([
                'assembly_id' => $assembly->id,
                'title' => $subjects[array_rand($subjects)],
                'proposed_by' => $names[array_rand($names)],
                'description' => 'Descripción del asunto a tratar en la asamblea',
                'state' => $assembly->status === 'Finalizada' ? ['Debatido', 'Solventado'][array_rand(['Debatido', 'Solventado'])] : 'Programado'
            ]);
            
            // Crear resoluciones para asuntos finalizados
            if ($assembly->status === 'Finalizada' && rand(0, 1)) {
                Resolution::create([
                    'assembly_id' => $assembly->id,
                    'subject_id' => $subject->id,
                    'title' => 'Resolución: ' . $subject->title,
                    'description' => 'Se resuelve aprobar/rechazar la propuesta presentada',
                    'resolution' => ['Aprobada por mayoría', 'Rechazada', 'Diferida para próxima sesión'][array_rand(['Aprobada por mayoría', 'Rechazada', 'Diferida para próxima sesión'])]
                ]);
            }
        }
    }
}
