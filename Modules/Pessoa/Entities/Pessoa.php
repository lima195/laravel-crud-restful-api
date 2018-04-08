<?php

namespace Modules\Pessoa\Entities;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{

		protected $table = 'pessoas';
		protected $guarded = ['id'];
		protected $fillable = ['nome', 'cpf'];
    protected $dates = ['nascimento'];
		public $timestamps = false;

}