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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('membresia_id');
            $table->unsignedBigInteger('tarifa_id')->nullable();
            $table->date('fecha_pago');
            $table->enum('estado', ['pendiente', 'completado', 'fallido']);
            $table->timestamps();
            $table->foreign('membresia_id')->references('id')->on('membresias')->onDelete('cascade');
            $table->foreign('tarifa_id')->references('id')->on('tarifas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
