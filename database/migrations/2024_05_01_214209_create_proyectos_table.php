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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();

            $table->unsignedBigInteger('info_laboral_id');
            $table->foreign('info_laboral_id')->references('id')->on('info_laborals')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias')
            ->onDelete('cascade')->onUpdate('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
