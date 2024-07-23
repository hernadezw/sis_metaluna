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
        Schema::create('envios', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('envio_no');
            $table->date('envio_fecha');

            $table->unsignedBigInteger('ruta_id')->nullable(true);
            $table->foreign('ruta_id')->references('id')->on('rutas');

            $table->string('proceso_id')->nullable(true);
            $table->string('proceso_nombre')->nullable(true);

            $table->string('estado_id')->nullable(true);
            $table->string('estado_nombre')->nullable(true);
            $table->string('estado_fecha')->nullable(true);
            $table->string('estado_observacion')->nullable(true);

            $table->string('user_id_created_at')->nullable(true);
            $table->string('user_name_created_at')->nullable(true);

            $table->string('observaciones_inicio_envio')->nullable(true);

            $table->string('observaciones_fin_envio')->nullable(true);

            $table->boolean('visible')->nullable(true);
            $table->boolean('finalizado')->nullable(true);

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
        Schema::dropIfExists('envios');
    }
};
