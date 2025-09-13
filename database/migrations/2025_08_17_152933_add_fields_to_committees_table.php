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
        Schema::table('committees', function (Blueprint $table) {
            $table->string('name');
            $table->unsignedBigInteger('responsible_id')->nullable();
            $table->enum('status', ['Creado', 'En Funciones', 'Suspendido'])->default('Creado');
            $table->date('creation_date');
            
            $table->foreign('responsible_id')->references('id')->on('members')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('committees', function (Blueprint $table) {
            $table->dropForeign(['responsible_id']);
            $table->dropColumn(['name', 'responsible_id', 'status', 'creation_date']);
        });
    }
};
