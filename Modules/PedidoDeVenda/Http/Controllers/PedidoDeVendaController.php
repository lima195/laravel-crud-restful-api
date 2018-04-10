<?php

namespace Modules\PedidoDeVenda\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\PedidoDeVenda\Entities\PedidoDeVenda;
use Modules\PedidoDeVenda\Entities\ItemPedido;
use Modules\Produto\Entities\Produto;

class PedidoDeVendaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        // return view('pedidodevenda::index');
        $pedidos = PedidoDeVenda::all();
        return response()->json($pedidos);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('pedidodevenda::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
      $valor_total_pedido = 0;
      $produtos_pedido = array();

      $request = $request->all();

      foreach ($request['produto'] as $index => $produto_id) {
        // var_dump($request); die;
        $produto = Produto::find($produto_id);

        $preco = $produto->preco;
        $desconto = $request['percentual_de_desconto'][$index];
        $quantidade = $request['quantidade'][$index] ? $request['quantidade'][$index] : 1;

        $valor_total = ($preco * $quantidade);
        if(isset($desconto) and ($desconto > 0)){
          $valor_total_desconto = (($valor_total * $desconto) / 100);
          $valor_total = $valor_total - $valor_total_desconto;
        }else{
          $desconto = 0;
        }

        $produtos_pedido[$produto_id] = array(
            'id' => $produto_id,
            'nome' => $produto->nome,
            'quantidade' => $quantidade,
            'desconto' => $desconto,
            'preco' => $preco,
            'valor_total' => $valor_total
          );

          $valor_total_pedido += $valor_total;
      }

      // var_dump($produtos_pedido); die;

      $id = 25;
      $emissao = date('Y-m-d');
      $total = $valor_total_pedido;
      $cliente = $request['pessoa'];

      $pedido_de_venda = array(
          'numero' => null,
          'id' => $id,
          'cliente' => $cliente,
          'emissao' => $emissao,
          'total' => $total,
        );
      // var_dump($pedido_de_venda); die;
      $pedido = new PedidoDeVenda();
      $pedido->fill($pedido_de_venda);
      $pedido->save();

      $numero = $pedido->id;

      foreach ($produtos_pedido as $index => $produto) {

        $produto_pedido = array(
          'id' => null,
          'produto' => intval($produto['id']),
          'quantidade' => intval($produto['quantidade']),
          'preco_unitario' => floatval($produto['preco']),
          'percentual_de_desconto' => floatval($produto['desconto']),
          'total' => floatval($produto['valor_total']),
          'numero_id' => $numero
        );

        // var_dump($produto_pedido); die;

        $item_pedido = new ItemPedido();
        $item_pedido->fill($produto_pedido);
        $item_pedido->save();
      }

      return response()->json($request);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('pedidodevenda::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('pedidodevenda::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
