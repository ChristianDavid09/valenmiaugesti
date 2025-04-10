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
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['consulta', 'sugerencia', 'reclamo', 'adopcion', 'otro']);
            $table->text('contenido');
            $table->enum('estado', ['pendiente', 'en proceso', 'resuelto'])->default('pendiente');
            $table->timestamp('fecha_envio')->useCurrent();
            $table->foreignId('id_adoptante')->constrained('adoptantes')->onDelete('cascade');
            $table->foreignId('id_colonia')->constrained('colonias')->onDelete('cascade');
            $table->foreignId('id_anuncio')->constrained('anuncios')->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensajes');
    }
};
