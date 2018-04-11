<?php

namespace Modules\Produto\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'produtos';
		protected $guarded = ['id'];
		protected $fillable = ['codigo', 'nome', 'preco'];
		public $timestamps = false;
}
