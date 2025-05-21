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
        Schema::create('adopt_advers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_adver')->constrained('advertisements')->onDelete('cascade');
            $table->foreignId('id_adopter')->constrained('adopters')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adopt_advers');
    }
};
