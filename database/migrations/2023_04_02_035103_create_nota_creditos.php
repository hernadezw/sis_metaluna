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
        Schema::create('nota_creditos', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('no_nota_credito');
            $table->unsignedBigInteger('venta_id')->nullable(true);
            $table->foreign('venta_id')->references('id')->on('ventas');
            $table->float('total_venta')->default(false)->nullable(true);
            $table->date('fecha_nota_credito');
            $table->float('total_nota_credito');
            $table->float('total_saldo')->comment('saldo de la venta despues de aplicado la nota de credito');
            $table->integer('correlativo')->default('0')->comment('correlativo para el seguimiento de las operaciones de abono y notas de credito');
            $table->boolean('anulacion_venta')->default(false)->nullable(true);
            $table->integer('cliente_id')->nullable(true);
            $table->string('observaciones')->nullable(true);
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
        Schema::dropIfExists('nota_creditos');
    }
};
