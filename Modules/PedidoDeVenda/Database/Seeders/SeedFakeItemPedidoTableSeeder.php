<?php

namespace Modules\PedidoDeVenda\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\PedidoDevenda\Entities\ItemPedido as ItemPedido;

class SeedFakeItemPedidoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('item_pedido')->insert([
          'id' => null,
          'produto' => 1,
          'quantidade' => 1,
          'preco_unitario' => 10.00,
          'percentual_de_desconto' => 50,
          'total' => 5.0,
          'numero_id' => 1,
        ]);

        DB::table('item_pedido')->insert([
          'id' => null,
          'produto' => 2,
          'quantidade' => 1,
          'preco_unitario' => 20.00,
          'percentual_de_desconto' => 0,
          'total' => 20.00,
          'numero_id' => 1,
        ]);

        DB::table('item_pedido')->insert([
          'id' => null,
          'produto' => 3,
          'quantidade' => 1,
          'preco_unitario' => 30.00,
          'percentual_de_desconto' => 0,
          'total' => 30.00,
          'numero_id' => 2,
        ]);

        DB::table('item_pedido')->insert([
          'id' => null,
          'produto' => 3,
          'quantidade' => 1,
          'preco_unitario' => 30.00,
          'percentual_de_desconto' => 0,
          'total' => 30.00,
          'numero_id' => 3,
        ]);

        DB::table('item_pedido')->insert([
          'id' => null,
          'produto' => 3,
          'quantidade' => 2,
          'preco_unitario' => 30.00,
          'percentual_de_desconto' => 0,
          'total' => 60.00,
          'numero_id' => 4,
        ]);

        // $this->call("OthersTableSeeder");
    }
}
