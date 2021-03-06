<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoDeVendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_de_venda', function (Blueprint $table) {

            $table->increments('numero')->unique();
            $table->uuid('id')->unique();
            $table->unsignedInteger('cliente');
            $table->date('emissao');
            $table->double('total', 8, 2);
            $table->foreign('cliente')->references('id')->on('pessoas');
            $table->softDeletes();


            // $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedido_de_venda');
    }
}
