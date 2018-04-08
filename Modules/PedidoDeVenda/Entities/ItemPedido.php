<?php

namespace Modules\PedidoDeVenda\Entities;

use Illuminate\Database\Eloquent\Model;

class ItemPedido extends Model
{
    protected $fillable = ['produto', 'quantidade', 'preco_unitario', 'percentual_de_desconto', 'total'];

    function company() {
        return $this->belongsTo('Modules\PedidoDeVenda\Entities\PedidoDeVenda');
    }
}
