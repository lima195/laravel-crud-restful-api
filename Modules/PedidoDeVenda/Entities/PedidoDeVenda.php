<?php

namespace Modules\PedidoDeVenda\Entities;

use Illuminate\Database\Eloquent\Model;

class PedidoDeVenda extends Model
{
    protected $table = 'pedido_de_venda';
		protected $guarded = ['id'];
    protected $fillable = ['id', 'cliente', 'numero', 'emissao', 'total'];
    public $timestamps = false;
}
