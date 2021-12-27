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
            $table->string('codigo')->nullable();
            $table->string('cliente')->nullable();
            $table->string('tipo_cliente')->nullable();
            $table->string('zona')->nullable();
            $table->string('gira')->nullable();
            $table->string('vendedor')->nullable();
            $table->string('n_documento')->nullable();
            $table->string('tipo_documento')->nullable();
            $table->string('f_comercial')->nullable();
            $table->string('fecha_emision')->nullable();
            $table->string('total')->nullable();
            $table->string('saldo_factura')->nullable();
            $table->string('saldo')->nullable();
            $table->string('fecha')->nullable();
            
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
