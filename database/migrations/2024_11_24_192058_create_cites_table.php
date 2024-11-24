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
        Schema::create('cites', function (Blueprint $table) {
            $table->id('cites_id');
            $table->unsignedBigInteger('Cites_profilesId');
            $table->foreign('Cites_profilesId')->references('profiles_id')->on('profiles');
            $table->unsignedBigInteger('Cites_propertiesId');
            $table->foreign('Cites_propertiesId')->references('properties_id')->on('properties');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cites');
    }
};
