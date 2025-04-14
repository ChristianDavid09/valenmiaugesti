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
        Schema::create('adoptantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('apellidos', 50);
            $table->date('fecha_nacimiento');
            $table->string('dni', 9)->unique();
            $table->string('email', 100)->unique();
            $table->string('telefono', 15)->nullable();
            $table->string('direccion', 255)->nullable();
            $table->string('provincia', 50)->nullable();
            $table->string('foto', 255)->nullable();
            $table->string('certificado', 255);
            $table->text('descripcion')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adoptantes');
    }
};
