<?php

namespace Modules\PedidoDeVenda\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\PedidoDeVenda\Entities\PedidoDeVenda;
use Modules\PedidoDeVenda\Entities\ItemPedido;
use Modules\Produto\Entities\Produto;
use Modules\Pessoa\Entities\Pessoa;
use Illuminate\Support\Facades\DB;

class PedidoDeVendaController extends Controller
{

    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        // return view('pedidodevenda::index');
        $pedidos = DB::table('pedido_de_venda')
            ->join('pessoas', 'cliente', '=', 'pessoas.id')
            ->select('pessoas.nome as nome', 'pedido_de_venda.numero', 'pedido_de_venda.id as id', 'pedido_de_venda.emissao', 'pedido_de_venda.total')
            ->get();


        $pedidos_list = array();

        foreach ($pedidos as $key => $pedido) {
          $pedidos[$key]->emissao = \Carbon\Carbon::parse($pedido->emissao)->format('d/m/Y');
        }

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
        $desconto = is_null($desconto) ? 0 : $desconto;
        $quantidade = $request['quantidade'][$index];
        $quantidade = is_null($quantidade) ? 1 : $quantidade;

        $valor_total = ($preco * $quantidade);
        if($desconto > 0){
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

      $id = (PedidoDeVenda::all()->last()->id + 1); // Force autoincrement
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
    public function show($id)
    {
        setlocale(LC_MONETARY, 'pt_BR');
        
        $pedido = PedidoDeVenda::where('numero', $id)
          ->join('pessoas', 'cliente', '=', 'pessoas.id')
          ->select('pedido_de_venda.numero', 'pedido_de_venda.emissao', 'pedido_de_venda.total', 'pessoas.nome')
          ->first();

        $produtos = ItemPedido::where('numero_id', $id)
          ->join('produtos', 'produto', '=', 'produtos.id')
          ->select('produtos.nome', 'item_pedido.total', 'item_pedido.preco_unitario', 'item_pedido.quantidade', 'item_pedido.percentual_de_desconto', 'produtos.id')
          ->get();
        $emissao = \Carbon\Carbon::parse($pedido->emissao)->format('d/m/Y');

        //$total = money_format('%i', $pedido->total);
        //$total = "R$ ".(str_replace('.', ',', $total));
        $total = $pedido->total;
        
        $pedido_view = array(
          'cliente' => $pedido->nome,
          'total' => $total,
          'emissao' => $emissao,
          'produtos' => $produtos,
        );
        return response()->json($pedido_view);
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
    public function destroy($id)
    {
      $pedido = PedidoDeVenda::where('numero', $id)->first();
      // $pedido->produtos->delete();

      

      if($pedido){

        foreach ($pedido->produtos as $key => $produto) {
          $produto->delete();
        }

        
        return response()->json($pedido->delete());
      }else{

      }
    }
}
