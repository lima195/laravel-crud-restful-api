<?php

namespace Modules\PedidoDeVenda\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\PedidoDeVenda\Entities\PedidoDeVenda;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemPedido extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'item_pedido';
    protected $fillable = ['produto', 'quantidade', 'preco_unitario', 'percentual_de_desconto', 'total', 'numero_id'];
    protected $guarded = ['id'];
    public $timestamps = false;

    public function pedidos()
    {
      return $this->hasOne('Modules\PedidoDeVenda\Entities\PedidoDeVenda', 'numero', 'numero_id');
    }
}
