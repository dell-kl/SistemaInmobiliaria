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
        Schema::create('responsibles', function (Blueprint $table) {
            $table->id('responsibles_id');
            $table->unsignedBigInteger('Responsibles_propertiesId');
            $table->foreign('Responsibles_propertiesId')->references('properties_id')->on('properties')->onDelete('cascade');
            $table->unsignedBigInteger('Responsibles_usersId');
            $table->foreign('Responsibles_usersId')->references('users_id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responsibles');
    }
};
