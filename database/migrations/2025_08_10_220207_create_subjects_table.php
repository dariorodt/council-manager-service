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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assembly_id')->nullable();
            $table->unsignedBigInteger('meeting_id')->nullable();
            $table->string('title');
            $table->string('proposed_by');
            $table->text('description');
            $table->enum('state', ['Programado', 'Debatido', 'Solventado']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
