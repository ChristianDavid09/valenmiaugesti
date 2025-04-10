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
        Schema::create('felinos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->integer('edad');
            $table->enum('sexo', ['Macho', 'Hembra']);
            $table->string('raza', 50)->nullable();
            $table->enum('estado_salud', ['Sano', 'En tratamiento', 'Fallecido'])->default('Sano');
            $table->foreignId('id_colonia')->constrained('colonias')->onDelete('cascade');
            $table->string('foto', 255)->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('felinos');
    }
};
