<?php

namespace Modules\Produto\Entities;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';
		protected $guarded = ['id'];
		protected $fillable = ['codigo', 'nome', 'preco'];
		public $timestamps = false;
}
