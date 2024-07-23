<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rutas', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('codigo')->nullable();
            $table->string('nombre')->nullable();
            $table->string('descripcion')->nullable();

            $table->integer('primero_direccion_departamento')->nullable();
            $table->integer('primero_direccion_municipio')->nullable();

            $table->integer('segundo_direccion_departamento')->nullable();
            $table->integer('segundo_direccion_municipio')->nullable();

            $table->integer('tercero_direccion_departamento')->nullable();
            $table->integer('tercero_direccion_municipio')->nullable();


            $table->integer('cuarto_direccion_departamento')->nullable();
            $table->integer('cuarto_direccion_municipio')->nullable();


            $table->integer('quinto_direccion_departamento')->nullable();
            $table->integer('quinto_direccion_municipio')->nullable();



            $table->boolean('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rutas');
    }
};
