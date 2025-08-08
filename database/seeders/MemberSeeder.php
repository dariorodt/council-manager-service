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
        \App\Models\Member::create([
            'name' => 'John Doe',
            'id_document' => '12345678',
            'date_of_birth' => '1990-01-01',
            'email' => 'john.doe@example.com',
            'phone' => '123-456-7890',
            'address' => '123 Main St',
            'unit' => 'Ejeecutiva',
            'membership_start_date' => '2025-01-01',
            'membership_end_date' => '2025-12-31',
            'status' => 'active',
        ]);

        // Inject 10 members using factory
        \App\Models\Member::factory()->count(10)->create();
    }
}
