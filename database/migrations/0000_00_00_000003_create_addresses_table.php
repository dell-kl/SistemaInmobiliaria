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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id('addresses_id');
            $table->string('addresses_name',100);
            //relacion con nuestro sector.
            $table->unsignedBigInteger('Addresses_sector_id');
            $table->foreign('Addresses_sector_id')->references('sectors_id')->on('sectors');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
