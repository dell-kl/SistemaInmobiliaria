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
        Schema::create('parroquias', function (Blueprint $table) {
            $table->id('parroquias_id');
            $table->string('parroquias_name');
            $table->boolean('parroquias_state', 1);

            //relacion con la tabla de cantones disponibles
            $table->unsignedBigInteger('Parroquias_cantonsId');
            $table->foreign('Parroquias_cantonsId')->references('cantons_id')->on('cantons');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parroquias');
    }
};
