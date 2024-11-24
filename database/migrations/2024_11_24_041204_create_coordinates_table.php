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
        Schema::create('coordinates', function (Blueprint $table) {
            $table->id('coordinates_id');
            $table->string('coordinates_route');
            //relacion con nuestra propiedad... <- esto nos servira mucho para la eliminacion CASCADE.
            $table->unsignedBigInteger('coordinates_propertiesId');
            $table->foreign('coordinates_propertiesId')->references('properties_id')->on('properties')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coordinates');
    }
};
