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
        Schema::create('carreras_por_estudiars', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->string('nivel_academico')->nullable();

            $table->unsignedBigInteger('info_academica_id');
            $table->foreign('info_academica_id')->references('id')->on('info_academicas')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carreras_por_estudiars');
    }
};
