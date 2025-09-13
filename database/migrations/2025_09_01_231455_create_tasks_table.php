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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('master_task_id')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->dateTime('planned_start')->nullable();
            $table->dateTime('real_start')->nullable();
            $table->string('duration')->nullable();
            $table->dateTime('expiration')->nullable();
            $table->dateTime('planned_end')->nullable();
            $table->dateTime('real_end')->nullable();
            $table->decimal('budget', 10, 2)->default(0);
            $table->enum('status', ['programada', 'en_ejecucion', 'suspendida'])->default('programada');
            $table->unsignedBigInteger('responsible_id')->nullable();
            $table->decimal('advance', 5, 2)->default(0);
            $table->timestamps();
            
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('master_task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('responsible_id')->references('id')->on('members')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
