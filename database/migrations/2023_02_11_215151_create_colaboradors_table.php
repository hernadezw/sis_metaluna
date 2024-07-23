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
        Schema::create('colaboradors', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('codigo')->unique()->nullable();
            $table->string('cui',13);
            $table->string('nombre',150)->nullable();
            $table->string('apellido',150);
            $table->date('fecha_nacimiento');
            $table->string('telefono_principal',12);
            $table->string('direccion_fisica',200);


            $table->string('correo_electronico',200);

            $table->string('tipo_licencia',200);
            $table->string('no_licencia',200);
            $table->string('tipo_sangre',200);
            $table->string('inicio_labores',200);
            $table->string('fin_labores',200);
            $table->string('usuario',200);
            $table->string('contrasenia',200);
            $table->boolean('estado');
            $table->timestamps();


            $table->unsignedBigInteger('departamento_id')->nullable();
            $table->foreign('departamento_id')->references('id')->on('departamentos');



            $table->unsignedBigInteger('municipio_id')->nullable();
            $table->foreign('municipio_id')->references('id')->on('municipios');


            $table->unsignedBigInteger('rol_id')->nullable();
            $table->foreign('rol_id')->references('id')->on('rols');




        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colaboradors');
    }
};
