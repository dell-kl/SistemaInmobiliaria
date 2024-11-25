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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id('profiles_id');
            $table->unsignedBigInteger('Profiles_usersId');
            $table->foreign('Profiles_usersId')->references('users_id')->on('users');
            $table->unsignedBigInteger('Profiles_rolesId');
            $table->foreign('Profiles_rolesId')->references('roles_id')->on('roles');
            $table->boolean('profiles_state', 1); //cada perfil tiene un estado de activo o inactivo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
