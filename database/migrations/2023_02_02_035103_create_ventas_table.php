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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id()->autoIncrement();


            $table->unsignedBigInteger('cliente_id')->nullable(true);
            $table->foreign('cliente_id')->references('id')->on('clientes');

            $table->string('no_venta');
            $table->date('fecha_venta');
            $table->time('hora_venta');
            $table->float('total_venta')->comment('costo total de la venta sin notas de credito');
            $table->float('saldo_credito')->comment('saldo de credito antes de la compra');
            $table->string('observaciones_venta')->nullable(true)->comment('observaciones sobre la venta');
            $table->string('forma_pago');

            /////efectivo///////////
            $table->boolean('efectivo')->default(0)->nullable(true)->comment('la venta fue cancelado ene fectivo');

            /////credito///////////
            $table->boolean('credito')->default(0)->nullable(true)->comment('fue aplicado un credito');
            $table->string('no_credito')->default(0)->nullable(true)->comment('numero de credito que esta asociado');
            $table->float('total_credito')->default(0)->nullable(true);
            $table->string('observaciones_credito')->nullable(true);
            /////anulado///////////
            $table->boolean('anulado')->default(false)->nullable(true)->comment('se anula una venta');
            $table->date('fecha_anulado')->nullable(true);
            $table->string('observaciones_anulado')->nullable(true);
            /////notacredito///////////
            $table->boolean('nota_credito')->default(0)->nullable(true)->comment('fue aplicado una nota de credito');
            $table->date('fecha_nota_credito')->nullable(true);
            $table->float('total_nota_credito')->default(0)->nullable(true);
            /////cancelado el total de la venta///////////
            $table->boolean('cancelado')->default(false)->nullable(true)->comment('se ha cancelado el monto total de la venta');
            $table->date('fecha_cancelado')->nullable(true);

            $table->float('saldo_venta')->default(0)->nullable(true)->comment('saldo total de la venta con notas de credito');

            $table->boolean('visible')->default(true)->nullable(true);


            $table->string('envio')->nullable(true)->default('SINENVIO')->comment('si requiere envio para asignarno a una hoja de ruta/envio');
            $table->string('estado_envio')->nullable(true)->default('NO/APLICA')->comment('finalizo el proceso de envio ruta/envio');

            $table->integer('correlativo')->nullable(true)->default('0')->comment('correlativo para el seguimiento de las operaciones de abono y notas de credito');


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
        Schema::dropIfExists('ventas');
    }
};
