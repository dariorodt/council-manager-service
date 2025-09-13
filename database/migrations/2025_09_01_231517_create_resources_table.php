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
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->string('name');
            $table->enum('type', ['material', 'personal', 'transporte', 'imprevistos']);
            $table->text('description')->nullable();
            $table->decimal('quantity', 10, 2);
            $table->string('unity');
            $table->decimal('unity_cost', 10, 2);
            $table->decimal('total_cost', 10, 2);
            $table->enum('status', ['planificado', 'en_stock', 'consumido'])->default('planificado');
            $table->timestamps();
            
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
