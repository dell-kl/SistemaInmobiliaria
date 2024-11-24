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
        Schema::create('interests', function (Blueprint $table) {
            $table->id('interests_id');
            $table->double('interests_rate'); //aqui va la tasa de interes de cada institucion el cual puede tener varias.
            $table->unsignedBigInteger('Interests_institutionsId');
            $table->foreign('Interests_institutionsId')->references('institutions_id')->on('institutions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interests');
    }
};
