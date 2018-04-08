<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemPedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_pedido', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('produto');
            $table->double('quantidade', 8, 2);
            $table->double('preco_unitario', 8, 2);
            $table->double('percentual_de_desconto', 8, 2);
            $table->double('total', 8, 2);
            $table->unsignedInteger('numero_id');
            $table->foreign('produto')->references('id')->on('produtos');
            $table->foreign('numero_id')->references('numero')->on('pedido_de_venda');

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
        Schema::dropIfExists('item_pedido');
    }
}
