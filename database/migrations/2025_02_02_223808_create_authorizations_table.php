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
        Schema::create('authorizations', function (Blueprint $table) {
            $table->id('authorizations_id');
            $table->unsignedBigInteger('authorizations_rolId');
            $table->foreign('authorizations_rolId')->references('roles_id')->on('roles');
            $table->unsignedBigInteger('authorizations_permissionId');
            $table->foreign('authorizations_permissionId')->references('permissions_id')->on('permissions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authorizations');
    }
};
