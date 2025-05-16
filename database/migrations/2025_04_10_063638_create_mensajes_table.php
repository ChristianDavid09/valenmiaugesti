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
            $table->enum('type', ['Consulta', 'Sugerencia', 'Reclamo', 'Adopcion', 'Otro']);
            $table->text('content');
            $table->enum('status', ['Pendiente', 'En proceso', 'Resuelto'])->default('Pendiente');
            $table->timestamp('date_send')->useCurrent();
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
