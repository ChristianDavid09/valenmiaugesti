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
            $table->string('name', 50);
            $table->integer('age');
            $table->enum('sex', ['Macho', 'Hembra']);
            $table->string('race', 50)->nullable();
            $table->enum('health_status', ['Sano', 'En tratamiento', 'Fallecido'])->default('Sano');
            $table->foreignId('id_colonia')->constrained('colonias')->onDelete('cascade');
            $table->string('photo', 255)->nullable();
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
