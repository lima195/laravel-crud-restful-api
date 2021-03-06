<?php

namespace Modules\PedidoDeVenda\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PedidoDeVendaDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call("Modules\PedidoDeVenda\Database\Seeders\SeedFakePedidosDeVendaTableSeeder");
        $this->call("Modules\PedidoDeVenda\Database\Seeders\SeedFakeItemPedidoTableSeeder");
    }
}
