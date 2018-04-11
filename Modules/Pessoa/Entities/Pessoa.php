<?php

namespace Modules\Pessoa\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa extends Model
{
	use SoftDeletes;
  protected $dates = ['deleted_at'];
	protected $table = 'pessoas';
	protected $guarded = ['id'];
	protected $fillable = ['nome', 'cpf', 'nascimento'];
	//protected $dates = ['nascimento'];
	public $timestamps = false;

	public function pedidos(){
		return $this->hasMany('Modules\PedidoDeVenda\Entities\PedidoDeVenda', 'cliente', 'id');
	}


}
