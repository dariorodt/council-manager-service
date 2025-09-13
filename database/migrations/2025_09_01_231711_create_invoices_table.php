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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->string('number');
            $table->date('invoice_date');
            $table->text('description')->nullable();
            $table->string('provider');
            $table->decimal('total', 10, 2);
            $table->enum('status', ['pendiente_por_pago', 'pagado', 'anulado'])->default('pendiente_por_pago');
            $table->unsignedBigInteger('document_id')->nullable();
            $table->timestamps();
            
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('document_id')->references('id')->on('documents')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
