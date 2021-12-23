<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Carteras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carteras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo');
            $table->string('cliente');
            $table->string('tipo_cliente');
            $table->string('zona');
            $table->string('gira');
            $table->string('vendedor');
            $table->string('n_documento');
            $table->string('tipo_documento');
            $table->string('f_comercial');
            $table->string('fecha_emision');
            $table->string('total');
            $table->string('saldo_factura');
            $table->string('saldo');
            $table->string('fecha');
            
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
        //
    }
}
