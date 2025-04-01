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
        Schema::create('entrenadors', function (Blueprint $table) {
            $table->foreignId('entrenador_id')->constrained('users')->onDelete('cascade')->primary();
            $table->string('especialidad');
            $table->string('experiencia');
            $table->string('disponibilidad');
            $table->integer('phone_number');
            $table->string('certificaciones', 255);
            $table->text('descripcion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrenadors');
    }
};
