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
        Schema::create('felines', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->integer('age');
            $table->enum('sex', ['Macho', 'Hembra'])->nullable();
            $table->string('race', 50)->nullable();
            $table->boolean('in_active')->default(false);
            $table->enum('Sterilized', ['Si', 'No'])->default('No');
            $table->enum('health_status', ['Sano', 'En tratamiento'])->default('Sano');
            $table->foreignId('id_cologne')->constrained('colognes')->onDelete('cascade');
            $table->string('photo', 255)->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('felines');
    }
};
