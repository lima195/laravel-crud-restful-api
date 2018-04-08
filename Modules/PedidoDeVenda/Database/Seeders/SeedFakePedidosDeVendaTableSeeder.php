<?php

namespace Modules\PedidoDeVenda\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\PedidoDevenda\Entities\PedidoDevenda as PedidoDevenda;

class SeedFakePedidosDeVendaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('pedido_de_venda')->insert([
          'id' => 1,
          'cliente' => 2,
          'numero' => null,
          'emissao' => '2018-02-07',
          'total' => (rand(50,200) / 10),
        ]);

        DB::table('pedido_de_venda')->insert([
          'id' => 2,
          'cliente' => 2,
          'numero' => null,
          'emissao' => '2018-03-07',
          'total' => (rand(50,200) / 10),
        ]);

        DB::table('pedido_de_venda')->insert([
          'id' => 3,
          'cliente' => 3,
          'numero' => null,
          'emissao' => '2018-04-07',
          'total' => (rand(50,200) / 10),
        ]);

        DB::table('pedido_de_venda')->insert([
          'id' => 4,
          'cliente' => 4,
          'numero' => null,
          'emissao' => '2018-04-07',
          'total' => (rand(50,200) / 10),
        ]);
    }
}
