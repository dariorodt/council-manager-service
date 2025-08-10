<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('id_document');
            $table->date('date_of_birth');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->enum('unit', [
                'Ejecutiva', 
                'Administrativa Financiera', 
                'Contraloría Social'
            ]);
            $table->date('membership_start_date');
            $table->date('membership_end_date');
            $table->enum('status', ['active', 'inactive']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
