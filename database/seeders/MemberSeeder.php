<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            ['name' => 'María González', 'id_document' => '12345678', 'email' => 'maria.gonzalez@example.com', 'unit' => 'Ejecutiva'],
            ['name' => 'Carlos Rodríguez', 'id_document' => '23456789', 'email' => 'carlos.rodriguez@example.com', 'unit' => 'Ejecutiva'],
            ['name' => 'Ana Martínez', 'id_document' => '34567890', 'email' => 'ana.martinez@example.com', 'unit' => 'Administrativa Financiera'],
            ['name' => 'Luis Pérez', 'id_document' => '45678901', 'email' => 'luis.perez@example.com', 'unit' => 'Administrativa Financiera'],
            ['name' => 'Carmen López', 'id_document' => '56789012', 'email' => 'carmen.lopez@example.com', 'unit' => 'Contraloría Social'],
            ['name' => 'José Hernández', 'id_document' => '67890123', 'email' => 'jose.hernandez@example.com', 'unit' => 'Contraloría Social'],
            ['name' => 'Isabel García', 'id_document' => '78901234', 'email' => 'isabel.garcia@example.com', 'unit' => 'Ejecutiva'],
            ['name' => 'Miguel Torres', 'id_document' => '89012345', 'email' => 'miguel.torres@example.com', 'unit' => 'Administrativa Financiera'],
            ['name' => 'Rosa Jiménez', 'id_document' => '90123456', 'email' => 'rosa.jimenez@example.com', 'unit' => 'Contraloría Social'],
            ['name' => 'Francisco Ruiz', 'id_document' => '01234567', 'email' => 'francisco.ruiz@example.com', 'unit' => 'Ejecutiva'],
            ['name' => 'Elena Morales', 'id_document' => '11234568', 'email' => 'elena.morales@example.com', 'unit' => 'Administrativa Financiera'],
            ['name' => 'Antonio Vargas', 'id_document' => '21234569', 'email' => 'antonio.vargas@example.com', 'unit' => 'Contraloría Social'],
            ['name' => 'Pilar Castro', 'id_document' => '31234570', 'email' => 'pilar.castro@example.com', 'unit' => 'Ejecutiva'],
            ['name' => 'Rafael Ortega', 'id_document' => '41234571', 'email' => 'rafael.ortega@example.com', 'unit' => 'Administrativa Financiera'],
            ['name' => 'Dolores Ramos', 'id_document' => '51234572', 'email' => 'dolores.ramos@example.com', 'unit' => 'Contraloría Social'],
            ['name' => 'Manuel Silva', 'id_document' => '61234573', 'email' => 'manuel.silva@example.com', 'unit' => 'Ejecutiva'],
            ['name' => 'Teresa Mendoza', 'id_document' => '71234574', 'email' => 'teresa.mendoza@example.com', 'unit' => 'Administrativa Financiera'],
            ['name' => 'Andrés Guerrero', 'id_document' => '81234575', 'email' => 'andres.guerrero@example.com', 'unit' => 'Contraloría Social'],
            ['name' => 'Lucía Herrera', 'id_document' => '91234576', 'email' => 'lucia.herrera@example.com', 'unit' => 'Ejecutiva'],
            ['name' => 'Pedro Aguilar', 'id_document' => '02234577', 'email' => 'pedro.aguilar@example.com', 'unit' => 'Administrativa Financiera']
        ];

        foreach ($members as $member) {
            \App\Models\Member::create([
                'name' => $member['name'],
                'id_document' => $member['id_document'],
                'date_of_birth' => fake()->dateTimeBetween('-60 years', '-25 years')->format('Y-m-d'),
                'email' => $member['email'],
                'phone' => fake()->phoneNumber(),
                'address' => fake()->address(),
                'unit' => $member['unit'],
                'membership_start_date' => '2025-01-01',
                'membership_end_date' => '2025-12-31',
                'status' => 'active',
            ]);
        }
    }
}
