<?php

namespace Modules\Produto\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Produto\Entities\Produto as Produto;

class SeedFakeProdutosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('produtos')->insert([
          'codigo' => rand(1000000,8000000),
          'nome' => 'Donut de Chocolate',
          'preco' => 10.00,
        ]);

        DB::table('produtos')->insert([
          'codigo' => rand(1000000,8000000),
          'nome' => 'Donut de Creme',
          'preco' => 20.00,
        ]);

        DB::table('produtos')->insert([
          'codigo' => rand(1000000,8000000),
          'nome' => 'Donut de Morango',
          'preco' => 30.00,
        ]);

        DB::table('produtos')->insert([
          'codigo' => rand(1000000,8000000),
          'nome' => 'Donut de Brigadeiro',
          'preco' => 40.00,
        ]);

        DB::table('produtos')->insert([
          'codigo' => rand(1000000,8000000),
          'nome' => 'Donut de Churros',
          'preco' => 50.00,
        ]);

        // $this->call("OthersTableSeeder");
    }
}
