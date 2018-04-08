<?php

namespace Modules\Pessoa\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PessoaDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call("Modules\Pessoa\Database\Seeders\SeedFakePessoasTableSeeder");
    }
}
