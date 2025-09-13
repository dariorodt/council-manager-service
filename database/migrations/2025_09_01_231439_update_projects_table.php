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
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('committee_id');
            $table->unsignedBigInteger('function_id')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('status', ['programado', 'en_ejecucion', 'suspendido', 'completado', 'cancelado'])->default('programado');
            $table->dateTime('planned_start')->nullable();
            $table->dateTime('real_start')->nullable();
            $table->dateTime('planned_end')->nullable();
            $table->string('duration')->nullable();
            $table->dateTime('real_end')->nullable();
            $table->decimal('advance', 5, 2)->default(0);
            
            $table->foreign('committee_id')->references('id')->on('committees')->onDelete('cascade');
            $table->foreign('function_id')->references('id')->on('committee_functions')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['committee_id']);
            $table->dropForeign(['function_id']);
            $table->dropColumn(['committee_id', 'function_id', 'name', 'description', 'status', 'planned_start', 'real_start', 'planned_end', 'duration', 'real_end', 'advance']);
        });
    }
};
