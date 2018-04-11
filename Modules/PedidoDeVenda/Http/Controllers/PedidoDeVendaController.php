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
    public function index(Request $request)
    {
        if($request->params){
          $params = $request->all()['params'][0];

          $pedidos = DB::table('pedido_de_venda')
            ->join('pessoas', 'cliente', '=', 'pessoas.id')
            ->select('pessoas.nome as nome', 'pedido_de_venda.numero', 'pedido_de_venda.id as id', 'pedido_de_venda.emissao', 'pedido_de_venda.total', 'pedido_de_venda.deleted_at', 'pessoas.deleted_at')
            ->whereNull('pedido_de_venda.deleted_at');



          if(isset($params['numero'])){
            $pedidos->where('numero', '=', $params['numero']);
          }

          if(isset($params['cliente'])){
            $pedidos = $pedidos->where('nome', '=', $params['cliente']);
          }

          if(isset($params['emissao'])){
            list($dia, $mes, $ano) = explode('/', $params['emissao']);
            $params['emissao'] = $ano."-".$mes."-".$dia;
            $pedidos = $pedidos->whereDate('emissao', '=', $params['emissao']);
          }

          if(isset($params['total'])){
            $params['total'] = (preg_replace('/[^0-9]/', '', $params['total'])/100);
            $pedidos = $pedidos->where('total', '=', $params['total']);
          }


          $pedidos = $pedidos->get();
        }else{
          $pedidos = DB::table('pedido_de_venda')
            ->join('pessoas', 'cliente', '=', 'pessoas.id')
            ->select('pessoas.nome as nome', 'pedido_de_venda.numero', 'pedido_de_venda.id as id', 'pedido_de_venda.emissao', 'pedido_de_venda.total', 'pedido_de_venda.deleted_at', 'pessoas.deleted_at')
            // ->whereNull('pessoas.deleted_at')
            ->whereNull('pedido_de_venda.deleted_at')
            ->get();
        }

        foreach ($pedidos as $key => $pedido) {
          $pedidos[$key]->emissao = \Carbon\Carbon::parse($pedido->emissao)->format('d/m/Y');
        }

        return response()->json($pedidos);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response->whereNull('pedido_de_venda.deleted_at')
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

        if(is_null($quantidade) or $quantidade == 0){
          header('HTTP/1.1 406');
          header('Content-Type: application/json; charset=UTF-8');
          die(json_encode(array('message' => "A quantidade para o produto (".$produto->nome.") deve ser maior que 0;", 'code' => '2')));
        }

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

      $id = (PedidoDeVenda::withTrashed()->get()->last()->id + 1); // Force autoincrement
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

      try{
        $pedido = new PedidoDeVenda();
        $pedido->fill($pedido_de_venda);
        $pedido->save();
      }catch(\Exception $e){
        $errorCode = $e->errorInfo;
        header('HTTP/1.1 406');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('message' => $errorCode[2], 'code' => $errorCode[1])));
      }

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

        try{
          $item_pedido = new ItemPedido();
          $item_pedido->fill($produto_pedido);
          $item_pedido->save();
        }catch(\Exception $e){
          $errorCode = $e->errorInfo;
          header('HTTP/1.1 406');
          header('Content-Type: application/json; charset=UTF-8');
          die(json_encode(array('message' => $errorCode[2], 'code' => $errorCode[1])));
        }
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

        if($pedido_view){
          return response()->json($pedido_view);
        }else{
          return false;
        }
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

      if($pedido){

        foreach ($pedido->produtos as $key => $produto) {
          try{
            $produto->delete();
          }catch(\Exception $e){
            $errorCode = $e->errorInfo;
            header('HTTP/1.1 406');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => $errorCode[2], 'code' => $errorCode[1])));
          }
        }

        return response()->json($pedido->delete());
      }
    }
}
