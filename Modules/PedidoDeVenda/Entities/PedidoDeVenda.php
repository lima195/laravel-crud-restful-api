<?php

namespace Modules\PedidoDeVenda\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\PedidoDeVenda\Entities\ItemPedido;
use Modules\Pessoa\Entities\Pessoa;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedidoDeVenda extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'pedido_de_venda';
    protected $guarded = ['id'];
    protected $fillable = ['id', 'cliente', 'numero', 'emissao', 'total'];
    public $timestamps = false;

    public function cliente()
    {
      return $this->hasOne('Modules\Pessoa\Entities\Pessoa', 'id', 'cliente');
    }

    public function produtos()
    {
        return $this->hasMany('Modules\PedidoDeVenda\Entities\ItemPedido', 'numero_id', 'numero');
    }
}
