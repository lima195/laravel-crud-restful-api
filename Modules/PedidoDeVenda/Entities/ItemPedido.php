<?php

namespace Modules\PedidoDeVenda\Entities;

use Illuminate\Database\Eloquent\Model;

class ItemPedido extends Model
{
    protected $table = 'item_pedido';
    protected $fillable = ['produto', 'quantidade', 'preco_unitario', 'percentual_de_desconto', 'total', 'numero_id'];
    protected $guarded = ['id'];
    public $timestamps = false;
}
