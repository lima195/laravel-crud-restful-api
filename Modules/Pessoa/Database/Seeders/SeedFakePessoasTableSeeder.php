<?php

namespace Modules\Pessoa\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Pessoa\Entities\Pessoa as Pessoa;

class SeedFakePessoasTableSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {

    Model::unguard();

    DB::table('pessoas')->insert([
      'nome' => 'Homer Simpson',
      'cpf' => '090.380.889-73',
      'nascimento' => '1995-06-19',
    ]);

    DB::table('pessoas')->insert([
      'nome' => 'Marge Simpson',
      'cpf' => '043.562.870-45',
      'nascimento' => '1995-02-11',
    ]);

    DB::table('pessoas')->insert([
      'nome' => 'Bartholomew Simpson',
      'cpf' => '756.682.030-34',
      'nascimento' => '1992-02-13',
    ]);

    DB::table('pessoas')->insert([
      'nome' => 'Lisa Simpson',
      'cpf' => '849.260.790-46',
      'nascimento' => '1989-04-11',
    ]);

    DB::table('pessoas')->insert([
      'nome' => 'Maggie Simpson',
      'cpf' => '849.260.790-46',
      'nascimento' => '2002-07-11',
    ]);

  }
}
