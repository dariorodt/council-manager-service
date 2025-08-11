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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->string('correlative');
            $table->enum('type', ['General', 'Extraordinaria', 'Informativa']);
            $table->enum('unit', ['Ejecutiva', 'Administrativa Financiera', 'Contraloría Social']);
            $table->unsignedBigInteger('committee_id')->nullable();
            $table->text('reason');
            $table->enum('status', ['Programada', 'Finalizada']);
            $table->dateTime('scheduled_date');
            $table->dateTime('actual_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
