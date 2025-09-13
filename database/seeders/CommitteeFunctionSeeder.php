<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommitteeFunctionSeeder extends Seeder
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

        $committeeFunctions = [
            0 => [ // Comité de Servicios Públicos
                ['nombre' => 'Gestión de agua potable', 'descripcion' => 'Supervisar y gestionar el suministro de agua potable en la comunidad', 'ref_act' => 'SP-001'],
                ['nombre' => 'Mantenimiento de alumbrado público', 'descripcion' => 'Coordinar reparación y mantenimiento del sistema de alumbrado', 'ref_act' => 'SP-002'],
                ['nombre' => 'Gestión de servicios eléctricos', 'descripcion' => 'Atender fallas y mejoras en el servicio eléctrico', 'ref_act' => 'SP-003'],
                ['nombre' => 'Supervisión de recolección de basura', 'descripcion' => 'Coordinar con entes la recolección de desechos sólidos', 'ref_act' => 'SP-004'],
                ['nombre' => 'Mantenimiento de redes de gas', 'descripcion' => 'Supervisar el estado de las redes de gas doméstico', 'ref_act' => 'SP-005'],
                ['nombre' => 'Gestión de telecomunicaciones', 'descripcion' => 'Coordinar mejoras en servicios de internet y telefonía', 'ref_act' => 'SP-006'],
                ['nombre' => 'Control de calidad de servicios', 'descripcion' => 'Evaluar la calidad de los servicios públicos prestados', 'ref_act' => 'SP-007']
            ],
            1 => [ // Comité de Salud y Prevención Comunitaria
                ['nombre' => 'Promoción de la salud preventiva', 'descripcion' => 'Organizar jornadas de prevención y promoción de la salud', 'ref_act' => 'SP-001'],
                ['nombre' => 'Coordinación con centros de salud', 'descripcion' => 'Establecer vínculos con ambulatorios y hospitales', 'ref_act' => 'SP-002'],
                ['nombre' => 'Campañas de vacunación', 'descripcion' => 'Apoyar y promover campañas de inmunización', 'ref_act' => 'SP-003'],
                ['nombre' => 'Educación sanitaria', 'descripcion' => 'Impartir charlas sobre higiene y saneamiento', 'ref_act' => 'SP-004'],
                ['nombre' => 'Control de vectores', 'descripcion' => 'Prevenir y controlar enfermedades transmitidas por vectores', 'ref_act' => 'SP-005'],
                ['nombre' => 'Atención a emergencias médicas', 'descripcion' => 'Coordinar primeros auxilios y traslados de emergencia', 'ref_act' => 'SP-006'],
                ['nombre' => 'Seguimiento nutricional', 'descripcion' => 'Monitorear el estado nutricional de la comunidad', 'ref_act' => 'SP-007'],
                ['nombre' => 'Salud mental comunitaria', 'descripcion' => 'Promover actividades de bienestar psicológico', 'ref_act' => 'SP-008']
            ],
            2 => [ // Comité de Educación y Cultura
                ['nombre' => 'Apoyo a instituciones educativas', 'descripcion' => 'Colaborar con escuelas y liceos de la comunidad', 'ref_act' => 'EC-001'],
                ['nombre' => 'Programas de alfabetización', 'descripcion' => 'Organizar cursos para adultos que no saben leer ni escribir', 'ref_act' => 'EC-002'],
                ['nombre' => 'Actividades culturales', 'descripcion' => 'Promover eventos artísticos y culturales', 'ref_act' => 'EC-003'],
                ['nombre' => 'Biblioteca comunitaria', 'descripcion' => 'Gestionar espacios de lectura y estudio', 'ref_act' => 'EC-004'],
                ['nombre' => 'Talleres de oficios', 'descripcion' => 'Organizar capacitación en oficios y habilidades', 'ref_act' => 'EC-005'],
                ['nombre' => 'Preservación del patrimonio', 'descripcion' => 'Proteger y promover la cultura local', 'ref_act' => 'EC-006'],
                ['nombre' => 'Educación ambiental', 'descripcion' => 'Impartir conocimientos sobre cuidado del ambiente', 'ref_act' => 'EC-007'],
                ['nombre' => 'Tecnología educativa', 'descripcion' => 'Promover el uso de tecnología en la educación', 'ref_act' => 'EC-008']
            ],
            3 => [ // Comité de Seguridad y Protección Civil
                ['nombre' => 'Prevención del delito', 'descripcion' => 'Implementar estrategias de seguridad ciudadana', 'ref_act' => 'SPC-001'],
                ['nombre' => 'Coordinación con cuerpos policiales', 'descripcion' => 'Establecer vínculos con policía y GNB', 'ref_act' => 'SPC-002'],
                ['nombre' => 'Planes de emergencia', 'descripcion' => 'Desarrollar protocolos ante desastres naturales', 'ref_act' => 'SPC-003'],
                ['nombre' => 'Capacitación en primeros auxilios', 'descripcion' => 'Formar brigadistas comunitarios', 'ref_act' => 'SPC-004'],
                ['nombre' => 'Sistema de alerta temprana', 'descripcion' => 'Implementar mecanismos de comunicación de emergencias', 'ref_act' => 'SPC-005'],
                ['nombre' => 'Vigilancia comunitaria', 'descripcion' => 'Organizar rondas de seguridad vecinal', 'ref_act' => 'SPC-006'],
                ['nombre' => 'Prevención de incendios', 'descripcion' => 'Educar sobre prevención y control de incendios', 'ref_act' => 'SPC-007']
            ],
            4 => [ // Comité de Infraestructura y Vialidad
                ['nombre' => 'Mantenimiento de calles', 'descripcion' => 'Supervisar reparación y asfaltado de vías', 'ref_act' => 'IV-001'],
                ['nombre' => 'Construcción de aceras', 'descripcion' => 'Gestionar proyectos de aceras y bordillos', 'ref_act' => 'IV-002'],
                ['nombre' => 'Drenajes y alcantarillado', 'descripcion' => 'Mantener sistemas de drenaje de aguas', 'ref_act' => 'IV-003'],
                ['nombre' => 'Señalización vial', 'descripcion' => 'Instalar y mantener señales de tránsito', 'ref_act' => 'IV-004'],
                ['nombre' => 'Espacios públicos', 'descripcion' => 'Mantener plazas, parques y áreas comunes', 'ref_act' => 'IV-005'],
                ['nombre' => 'Puentes y pasos peatonales', 'descripcion' => 'Supervisar infraestructura de conexión', 'ref_act' => 'IV-006'],
                ['nombre' => 'Transporte público', 'descripcion' => 'Coordinar mejoras en el servicio de transporte', 'ref_act' => 'IV-007'],
                ['nombre' => 'Estacionamientos públicos', 'descripcion' => 'Gestionar espacios de estacionamiento', 'ref_act' => 'IV-008']
            ],
            5 => [ // Comité de Juventud y Deporte
                ['nombre' => 'Actividades deportivas', 'descripcion' => 'Organizar torneos y competencias deportivas', 'ref_act' => 'JD-001'],
                ['nombre' => 'Mantenimiento de canchas', 'descripcion' => 'Cuidar instalaciones deportivas comunitarias', 'ref_act' => 'JD-002'],
                ['nombre' => 'Programas juveniles', 'descripcion' => 'Desarrollar actividades para jóvenes', 'ref_act' => 'JD-003'],
                ['nombre' => 'Escuelas deportivas', 'descripcion' => 'Crear programas de formación deportiva', 'ref_act' => 'JD-004'],
                ['nombre' => 'Recreación familiar', 'descripcion' => 'Organizar actividades recreativas para familias', 'ref_act' => 'JD-005'],
                ['nombre' => 'Liderazgo juvenil', 'descripcion' => 'Formar líderes comunitarios jóvenes', 'ref_act' => 'JD-006'],
                ['nombre' => 'Prevención de drogas', 'descripcion' => 'Implementar programas preventivos', 'ref_act' => 'JD-007']
            ],
            6 => [ // Comité de Economía Popular y Producción
                ['nombre' => 'Microcréditos comunitarios', 'descripcion' => 'Gestionar fondos para emprendimientos', 'ref_act' => 'EPP-001'],
                ['nombre' => 'Capacitación empresarial', 'descripcion' => 'Formar emprendedores y microempresarios', 'ref_act' => 'EPP-002'],
                ['nombre' => 'Mercados comunitarios', 'descripcion' => 'Organizar espacios de comercialización', 'ref_act' => 'EPP-003'],
                ['nombre' => 'Cooperativas de producción', 'descripcion' => 'Promover asociaciones productivas', 'ref_act' => 'EPP-004'],
                ['nombre' => 'Agricultura urbana', 'descripcion' => 'Impulsar huertos y cultivos comunitarios', 'ref_act' => 'EPP-005'],
                ['nombre' => 'Turismo comunitario', 'descripcion' => 'Desarrollar potencial turístico local', 'ref_act' => 'EPP-006'],
                ['nombre' => 'Comercio justo', 'descripcion' => 'Promover intercambios comerciales equitativos', 'ref_act' => 'EPP-007'],
                ['nombre' => 'Innovación productiva', 'descripcion' => 'Fomentar nuevas tecnologías productivas', 'ref_act' => 'EPP-008']
            ],
            7 => [ // Comité de Ambiente y Reciclaje
                ['nombre' => 'Reciclaje de materiales', 'descripcion' => 'Organizar programas de reciclaje comunitario', 'ref_act' => 'AR-001'],
                ['nombre' => 'Educación ambiental', 'descripcion' => 'Sensibilizar sobre cuidado del ambiente', 'ref_act' => 'AR-002'],
                ['nombre' => 'Reforestación', 'descripcion' => 'Plantar y cuidar árboles en la comunidad', 'ref_act' => 'AR-003'],
                ['nombre' => 'Gestión de residuos', 'descripcion' => 'Clasificar y manejar adecuadamente los desechos', 'ref_act' => 'AR-004'],
                ['nombre' => 'Conservación del agua', 'descripcion' => 'Promover uso racional del recurso hídrico', 'ref_act' => 'AR-005'],
                ['nombre' => 'Energías renovables', 'descripcion' => 'Impulsar uso de energías limpias', 'ref_act' => 'AR-006'],
                ['nombre' => 'Jardines comunitarios', 'descripcion' => 'Crear y mantener espacios verdes', 'ref_act' => 'AR-007']
            ],
            8 => [ // Comité de Atención a Personas con Discapacidad y Adultos Mayores
                ['nombre' => 'Atención integral a discapacitados', 'descripcion' => 'Brindar apoyo a personas con discapacidad', 'ref_act' => 'APDAM-001'],
                ['nombre' => 'Cuidado de adultos mayores', 'descripcion' => 'Atender necesidades de la tercera edad', 'ref_act' => 'APDAM-002'],
                ['nombre' => 'Accesibilidad urbana', 'descripcion' => 'Promover espacios accesibles para todos', 'ref_act' => 'APDAM-003'],
                ['nombre' => 'Programas de rehabilitación', 'descripcion' => 'Coordinar terapias y rehabilitación', 'ref_act' => 'APDAM-004'],
                ['nombre' => 'Actividades recreativas', 'descripcion' => 'Organizar entretenimiento para estos grupos', 'ref_act' => 'APDAM-005'],
                ['nombre' => 'Capacitación laboral', 'descripcion' => 'Formar para inserción laboral', 'ref_act' => 'APDAM-006'],
                ['nombre' => 'Apoyo psicosocial', 'descripcion' => 'Brindar acompañamiento emocional', 'ref_act' => 'APDAM-007'],
                ['nombre' => 'Gestión de beneficios', 'descripcion' => 'Tramitar pensiones y ayudas sociales', 'ref_act' => 'APDAM-008']
            ],
            9 => [ // Comité de Comunicación y Medios Comunitarios
                ['nombre' => 'Radio comunitaria', 'descripcion' => 'Gestionar emisora de radio local', 'ref_act' => 'CMC-001'],
                ['nombre' => 'Boletín informativo', 'descripcion' => 'Publicar noticias y actividades comunitarias', 'ref_act' => 'CMC-002'],
                ['nombre' => 'Redes sociales', 'descripcion' => 'Administrar cuentas digitales del consejo', 'ref_act' => 'CMC-003'],
                ['nombre' => 'Carteleras informativas', 'descripcion' => 'Mantener información actualizada en espacios públicos', 'ref_act' => 'CMC-004'],
                ['nombre' => 'Documentación audiovisual', 'descripcion' => 'Registrar actividades y eventos importantes', 'ref_act' => 'CMC-005'],
                ['nombre' => 'Capacitación comunicacional', 'descripcion' => 'Formar comunicadores populares', 'ref_act' => 'CMC-006'],
                ['nombre' => 'Página web comunitaria', 'descripcion' => 'Mantener sitio web del consejo comunal', 'ref_act' => 'CMC-007'],
                ['nombre' => 'Eventos de difusión', 'descripcion' => 'Organizar actividades de comunicación masiva', 'ref_act' => 'CMC-008']
            ]
        ];

        foreach ($committeeFunctions as $index => $functions) {
            if (isset($committees[$index])) {
                $selectedFunctions = array_slice($functions, 0, rand(6, 9));
                foreach ($selectedFunctions as $function) {
                    \App\Models\CommitteeFunction::create([
                        'committee_id' => $committees[$index]->id,
                        'nombre' => $function['nombre'],
                        'descripcion' => $function['descripcion'],
                        'ref_act' => $function['ref_act'],
                    ]);
                }
            }
        }
    }
}
