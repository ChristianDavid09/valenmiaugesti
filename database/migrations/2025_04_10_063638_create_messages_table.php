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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Consulta', 'Adopcion', 'Otro']);
            $table->text('content');
            $table->enum('status', ['Pendiente', 'En proceso', 'Resuelto'])->default('Pendiente');
            $table->timestamp('date_send')->useCurrent();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_cologne')->constrained('colognes')->onDelete('cascade');
            $table->foreignId('id_adver')->constrained('advertisements')->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
