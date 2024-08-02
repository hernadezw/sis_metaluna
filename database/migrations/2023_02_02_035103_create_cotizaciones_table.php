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
        Schema::create('cotizacions', function (Blueprint $table) {
            $table->id()->autoIncrement();


            $table->unsignedBigInteger('cliente_id')->nullable(true);
            $table->foreign('cliente_id')->references('id')->on('clientes');

            $table->string('no_cotizacion');
            $table->date('fecha_cotizacion');
            $table->float('total_cotizacion')->comment('costo total de la venta sin notas de credito');
            $table->string('observaciones_cotizacion')->nullable(true)->comment('observaciones sobre la venta');
            $table->string('forma_pago');

            /////cancelado el total de la venta///////////
            $table->boolean('cancelado')->default(false)->nullable(true)->comment('se ha cancelado el monto total de la venta');
            $table->date('fecha_cancelado')->nullable(true);

            $table->boolean('visible')->default(true)->nullable(true);

            $table->unsignedBigInteger('sucursal_id')->nullable(true);
            $table->foreign('sucursal_id')->references('id')->on('sucursals');
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
        Schema::dropIfExists('cotizacions');
    }
};
