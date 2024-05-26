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
        Schema::create('bandgeneros', function (Blueprint $table) {
            $table->unsignedBigInteger('band_id');
            $table->unsignedBigInteger('genero_id');
            $table->primary(['band_id', 'genero_id']);
            $table->foreign('band_id')->references('id')->on('bands')->onDelete('cascade');
            $table->foreign('genero_id')->references('id')->on('generos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bandgeneros');
    }
};
