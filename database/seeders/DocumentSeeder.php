<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documents = [
            [
                'name' => 'Reglamento Interno del Consejo',
                'extension' => 'pdf',
                'description' => 'Documento que establece las normas y procedimientos internos del consejo comunal.',
                'url' => '/storage/documents/reglamento-interno.pdf'
            ],
            [
                'name' => 'Acta de Constitución',
                'extension' => 'pdf',
                'description' => 'Acta fundacional del consejo comunal con todos los miembros fundadores.',
                'url' => '/storage/documents/acta-constitucion.pdf'
            ],
            [
                'name' => 'Presupuesto Anual 2025',
                'extension' => 'xlsx',
                'description' => 'Presupuesto detallado para el ejercicio fiscal 2025.',
                'url' => '/storage/documents/presupuesto-2025.xlsx'
            ],
            [
                'name' => 'Plan de Trabajo Comunitario',
                'extension' => 'docx',
                'description' => 'Plan de actividades y proyectos para el desarrollo de la comunidad.',
                'url' => '/storage/documents/plan-trabajo.docx'
            ],
            [
                'name' => 'Informe de Gestión Trimestral',
                'extension' => 'pdf',
                'description' => 'Reporte de actividades y logros del primer trimestre del año.',
                'url' => '/storage/documents/informe-trimestral.pdf'
            ],
            [
                'name' => 'Censo Poblacional',
                'extension' => 'xlsx',
                'description' => 'Registro actualizado de habitantes y familias de la comunidad.',
                'url' => '/storage/documents/censo-poblacional.xlsx'
            ],
            [
                'name' => 'Proyecto Mejoras Viales',
                'extension' => 'pdf',
                'description' => 'Propuesta para el mejoramiento de calles y aceras del sector.',
                'url' => '/storage/documents/proyecto-viales.pdf'
            ]
        ];

        foreach ($documents as $document) {
            \App\Models\Document::create([
                'name' => $document['name'],
                'extension' => $document['extension'],
                'description' => $document['description'],
                'transcription' => null,
                'url' => $document['url'],
                'created_by' => 1,
                'updated_by' => 1,
            ]);
        }
    }
}
