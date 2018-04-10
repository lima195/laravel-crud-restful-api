<?php

namespace Modules\Pessoa\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Pessoa\Entities\Pessoa;
use Illuminate\Support\Facades\DB;
use Modules\PedidoDeVenda\Entities\PedidoDeVenda;
use Modules\PedidoDeVenda\Entities\ItemPedido;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $pessoas = DB::table('pessoas')->get();

        foreach ($pessoas as $key => $pessoa) {
          $pessoas[$key]->nascimento = \Carbon\Carbon::parse($pessoa->nascimento)->format('d/m/Y');
        }

        return response()->json($pessoas);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('pessoa::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $request = $request->all();

        $pessoa_save = array(
            'id' => null,
            'nome' => $request['nome'],
            'cpf' => $request['cpf'],
            'nascimento' => $request['nascimento']
        );

        $pessoa = new Pessoa();
        $pessoa->fill($pessoa_save);
        $pessoa->save();

        return response()->json($pessoa_save);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        
        $pessoa = Pessoa::find($id);

        // $produtos = ItemPedido::where('numero_id', $id)
        //  ->join('produtos', 'produto', '=', 'produtos.id')
        //   ->select('produtos.nome', 'item_pedido.total', 'item_pedido.preco_unitario', 'item_pedido.quantidade', 'item_pedido.percentual_de_desconto', 'produtos.id')
        //   ->get();
        // $emissao = \Carbon\Carbon::parse($pedido->emissao)->format('d/m/Y');

        //$total = money_format('%i', $pedido->total);
        //$total = "R$ ".(str_replace('.', ',', $total));
        // $total = $pedido->total;
        
        
        return response()->json($pessoa);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('pessoa::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $request = $request->all();

        if($id = $request['id']){
            $pessoa = Pessoa::find($id);
            $pessoa->fill($request);
            $save = $pessoa->save();
        }

        return response()->json($save);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $pessoa = Pessoa::find($id)->first();

        return response()->json($pessoa->delete());
    }
}
