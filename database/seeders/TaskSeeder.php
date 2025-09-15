<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing tasks
        \App\Models\Task::truncate();
        
        $projects = \App\Models\Project::all();
        
        if ($projects->isEmpty()) {
            $this->command->warn('No projects found. Please run ProjectSeeder first.');
            return;
        }

        $projectTasks = [
            'Mejoramiento del Sistema de Agua Potable' => [
                ['name' => 'Estudio técnico del sistema actual', 'description' => 'Evaluación del estado de las tuberías y sistemas existentes'],
                ['name' => 'Diseño de nuevas redes', 'description' => 'Elaboración de planos para la nueva red de distribución'],
                ['name' => 'Adquisición de materiales', 'description' => 'Compra de tuberías, válvulas y accesorios necesarios'],
                ['name' => 'Excavación de zanjas', 'description' => 'Apertura de zanjas para instalación de nuevas tuberías'],
                ['name' => 'Instalación de tuberías principales', 'description' => 'Colocación de la red principal de distribución'],
                ['name' => 'Conexiones domiciliarias', 'description' => 'Instalación de acometidas a cada vivienda'],
                ['name' => 'Instalación de sistema de filtración', 'description' => 'Montaje de equipos de purificación de agua'],
                ['name' => 'Pruebas de presión', 'description' => 'Verificación del funcionamiento del sistema'],
                ['name' => 'Capacitación a usuarios', 'description' => 'Instrucción sobre uso y mantenimiento del sistema'],
                ['name' => 'Puesta en funcionamiento', 'description' => 'Activación del nuevo sistema de agua potable']
            ],
            'Campaña de Vacunación Comunitaria' => [
                ['name' => 'Coordinación con Ministerio de Salud', 'description' => 'Establecimiento de acuerdos para suministro de vacunas'],
                ['name' => 'Censo de población objetivo', 'description' => 'Identificación de niños y adultos mayores a vacunar'],
                ['name' => 'Capacitación de personal', 'description' => 'Entrenamiento de voluntarios para apoyo en jornadas'],
                ['name' => 'Adecuación de espacios', 'description' => 'Preparación de locales para jornadas de vacunación'],
                ['name' => 'Campaña informativa', 'description' => 'Difusión de fechas y beneficios de la vacunación'],
                ['name' => 'Primera jornada de vacunación', 'description' => 'Aplicación de primeras dosis según esquema'],
                ['name' => 'Seguimiento y registro', 'description' => 'Control de personas vacunadas y efectos adversos'],
                ['name' => 'Segunda jornada de vacunación', 'description' => 'Aplicación de refuerzos y segundas dosis'],
                ['name' => 'Evaluación de cobertura', 'description' => 'Análisis de porcentaje de población inmunizada']
            ],
            'Biblioteca Comunitaria Digital' => [
                ['name' => 'Selección del local', 'description' => 'Identificación y adecuación del espacio para la biblioteca'],
                ['name' => 'Diseño del espacio', 'description' => 'Planificación de distribución de áreas de lectura y computación'],
                ['name' => 'Adquisición de mobiliario', 'description' => 'Compra de estanterías, mesas, sillas y escritorios'],
                ['name' => 'Instalación eléctrica', 'description' => 'Adecuación de sistema eléctrico para equipos'],
                ['name' => 'Compra de equipos informáticos', 'description' => 'Adquisición de computadoras, impresoras y router'],
                ['name' => 'Instalación de internet', 'description' => 'Contratación y configuración de servicio de internet'],
                ['name' => 'Adquisición de libros', 'description' => 'Compra de material bibliográfico físico y digital'],
                ['name' => 'Capacitación de bibliotecarios', 'description' => 'Entrenamiento de personal para manejo de la biblioteca'],
                ['name' => 'Inauguración', 'description' => 'Evento de apertura y presentación a la comunidad'],
                ['name' => 'Programas de promoción', 'description' => 'Actividades para fomentar el uso de la biblioteca']
            ],
            'Sistema de Vigilancia Comunitaria' => [
                ['name' => 'Estudio de puntos estratégicos', 'description' => 'Identificación de ubicaciones para instalación de cámaras'],
                ['name' => 'Adquisición de cámaras', 'description' => 'Compra de equipos de videovigilancia y grabación'],
                ['name' => 'Instalación de cámaras', 'description' => 'Montaje de cámaras en puntos seleccionados'],
                ['name' => 'Centro de monitoreo', 'description' => 'Adecuación de espacio para vigilancia centralizada'],
                ['name' => 'Capacitación de operadores', 'description' => 'Entrenamiento para manejo del sistema de cámaras'],
                ['name' => 'Organización de rondas', 'description' => 'Estructuración de grupos vecinales de vigilancia'],
                ['name' => 'Capacitación en seguridad', 'description' => 'Instrucción sobre técnicas de vigilancia comunitaria'],
                ['name' => 'Coordinación policial', 'description' => 'Establecimiento de protocolos con cuerpos de seguridad'],
                ['name' => 'Sistema de comunicaciones', 'description' => 'Instalación de radios y teléfonos de emergencia'],
                ['name' => 'Pruebas del sistema', 'description' => 'Verificación del funcionamiento integral'],
                ['name' => 'Puesta en operación', 'description' => 'Inicio formal del sistema de vigilancia']
            ],
            'Asfaltado de Calles Principales' => [
                ['name' => 'Levantamiento topográfico', 'description' => 'Medición y mapeo de las calles a asfaltar'],
                ['name' => 'Estudio de suelos', 'description' => 'Análisis de la capacidad portante del terreno'],
                ['name' => 'Diseño de pavimento', 'description' => 'Cálculo de espesores y especificaciones técnicas'],
                ['name' => 'Adquisición de materiales', 'description' => 'Compra de asfalto, agregados y materiales de señalización'],
                ['name' => 'Preparación de base', 'description' => 'Nivelación y compactación del terreno'],
                ['name' => 'Aplicación de asfalto', 'description' => 'Colocación de la carpeta asfáltica'],
                ['name' => 'Señalización horizontal', 'description' => 'Pintado de líneas y demarcaciones viales'],
                ['name' => 'Señalización vertical', 'description' => 'Instalación de señales de tránsito'],
                ['name' => 'Construcción de aceras', 'description' => 'Pavimentación de andenes peatonales'],
                ['name' => 'Limpieza final', 'description' => 'Retiro de escombros y limpieza general']
            ],
            'Cancha Deportiva Multiusos' => [
                ['name' => 'Selección del terreno', 'description' => 'Identificación y adquisición del lote para la cancha'],
                ['name' => 'Diseño arquitectónico', 'description' => 'Elaboración de planos para cancha multiusos'],
                ['name' => 'Preparación del terreno', 'description' => 'Nivelación y compactación del suelo'],
                ['name' => 'Construcción de drenajes', 'description' => 'Instalación de sistema de evacuación de aguas'],
                ['name' => 'Pavimentación de cancha', 'description' => 'Colocación de superficie deportiva'],
                ['name' => 'Demarcación deportiva', 'description' => 'Pintado de líneas para diferentes deportes'],
                ['name' => 'Instalación de porterías', 'description' => 'Montaje de arcos y cestas deportivas'],
                ['name' => 'Sistema de iluminación', 'description' => 'Instalación de torres y luminarias'],
                ['name' => 'Construcción de graderías', 'description' => 'Edificación de área para espectadores'],
                ['name' => 'Inauguración deportiva', 'description' => 'Evento de apertura con torneos']
            ],
            'Mercado Comunitario' => [
                ['name' => 'Estudio de factibilidad', 'description' => 'Análisis de viabilidad económica del mercado'],
                ['name' => 'Selección de ubicación', 'description' => 'Identificación del lugar estratégico para el mercado'],
                ['name' => 'Diseño de instalaciones', 'description' => 'Planificación de puestos y áreas comunes'],
                ['name' => 'Construcción de estructura', 'description' => 'Edificación de techos y divisiones'],
                ['name' => 'Instalaciones sanitarias', 'description' => 'Construcción de baños y sistemas de agua'],
                ['name' => 'Instalación eléctrica', 'description' => 'Cableado y conexiones para cada puesto'],
                ['name' => 'Registro de comerciantes', 'description' => 'Inscripción y selección de vendedores'],
                ['name' => 'Capacitación comercial', 'description' => 'Entrenamiento en técnicas de venta y atención'],
                ['name' => 'Reglamento interno', 'description' => 'Elaboración de normas de funcionamiento'],
                ['name' => 'Inauguración comercial', 'description' => 'Apertura oficial del mercado comunitario']
            ],
            'Programa de Reciclaje Comunitario' => [
                ['name' => 'Diagnóstico de residuos', 'description' => 'Estudio de tipos y cantidades de desechos generados'],
                ['name' => 'Diseño del programa', 'description' => 'Planificación de sistema de recolección selectiva'],
                ['name' => 'Adquisición de contenedores', 'description' => 'Compra de recipientes para clasificación'],
                ['name' => 'Ubicación de puntos de acopio', 'description' => 'Instalación de contenedores en sitios estratégicos'],
                ['name' => 'Campaña educativa', 'description' => 'Sensibilización sobre importancia del reciclaje'],
                ['name' => 'Capacitación de recicladores', 'description' => 'Entrenamiento de personal para manejo de residuos'],
                ['name' => 'Inicio de recolección', 'description' => 'Puesta en marcha del sistema de recolección'],
                ['name' => 'Centro de acopio', 'description' => 'Establecimiento de lugar para almacenamiento'],
                ['name' => 'Comercialización', 'description' => 'Venta de materiales reciclables'],
                ['name' => 'Evaluación de resultados', 'description' => 'Medición de impacto ambiental y económico']
            ]
        ];

        foreach ($projects as $project) {
            $tasks = $projectTasks[$project->name] ?? [];
            $numTasks = rand(8, min(12, count($tasks)));
            $selectedTasks = array_slice($tasks, 0, $numTasks);
            
            foreach ($selectedTasks as $index => $taskData) {
                $status = $this->getRandomStatus();
                $advance = $this->getAdvanceByStatus($status);
                
                $taskData = array_merge($taskData, [
                    'project_id' => $project->id,
                    'status' => $status,
                    'advance' => $advance,
                    'planned_start' => $project->planned_start,
                    'planned_end' => $project->planned_end,
                    'duration' => rand(5, 30),
                    'budget' => rand(1000, 50000),
                    'responsible_id' => rand(1, 20), // Random member 1-20
                ]);
                
                // Add real dates based on status
                if ($status === 'en_ejecucion') {
                    $taskData['real_start'] = $project->planned_start ? 
                        $project->planned_start->addDays(rand(0, 10)) : now()->subDays(rand(1, 30));
                } elseif ($status === 'suspendida') {
                    $taskData['real_start'] = $project->planned_start ? 
                        $project->planned_start->addDays(rand(0, 10)) : now()->subDays(rand(1, 30));
                    $taskData['real_end'] = $project->planned_end ? 
                        $project->planned_end->subDays(rand(1, 15)) : now()->subDays(rand(1, 15));
                }
                
                \App\Models\Task::create($taskData);
            }
        }
    }

    private function getRandomStatus()
    {
        $statuses = ['programada', 'en_ejecucion', 'suspendida'];
        return $statuses[array_rand($statuses)];
    }
    
    private function getAdvanceByStatus($status)
    {
        switch ($status) {
            case 'programada':
                return 0;
            case 'en_ejecucion':
                return rand(10, 90);
            case 'suspendida':
                return rand(20, 80);
            default:
                return 0;
        }
    }
}
