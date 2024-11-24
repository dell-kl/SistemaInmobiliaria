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
        Schema::create('properties', function (Blueprint $table) {
            $table->id('properties_id');
            $table->integer('properties_rooms')->nullable(true);
            $table->string('properties_bathrooms',100)->nullable(true);
            $table->integer('properties_parking')->nullable(true);
            $table->decimal('properties_price');
            $table->tinyInteger('properties_availability'); //disponiblidad 3 estados 
            $table->string('properties_height');
            $table->string('properties_area');
            $table->string('properties_description');
            $table->boolean('properties_state',0); //eliminador logico 0 o 1.
            //relaciones 
            $table->unsignedBigInteger('Properties_typePropertieId');
            $table->foreign('Properties_typePropertieId')->references('typeProperties_id')->on('type_properties');
            $table->unsignedBigInteger('Properties_addressesId');
            $table->foreign('Properties_addressesId')->references('addresses_id')->on('addresses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
