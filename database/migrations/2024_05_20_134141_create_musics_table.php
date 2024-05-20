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
        Schema::create('musics', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('photo')->default('music/musicCoverDefault.png');
            $table->unsignedBigInteger('band_id');
            $table->double('length');
            $table->foreign('band_id')->references('id')->on('bands');
            $table->unsignedBigInteger('album_id');
            $table->foreign('album_id')->references('id')->on('albums');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('musics');
    }
};
