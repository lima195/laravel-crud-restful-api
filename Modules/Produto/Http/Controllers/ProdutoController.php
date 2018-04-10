<?php

namespace Modules\Produto\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Produto\Entities\Produto;
use Illuminate\Support\Facades\DB;
use Modules\PedidoDeVenda\Entities\PedidoDeVenda;
use Modules\PedidoDeVenda\Entities\ItemPedido;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $produtos = DB::table('produtos')->get();
        return response()->json($produtos);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('produto::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request = $request->all();

        $produto_save = array(
            'id' => null,
            'codigo' => $request['codigo'],
            'nome' => $request['nome'],
            'preco' => $request['preco']
        );

        $produto = new Produto();
        $produto->fill($produto_save);
        $produto->save();

        return response()->json($produto_save);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $produto = Produto::find($id);
        return response()->json($produto);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('produto::edit');
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
            $produto = Produto::find($id);
            $produto->fill($request);
            $save = $produto->save();
        }

        return response()->json($save);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $produto = Produto::find($id)->first();

        return response()->json($produto->delete());
    }
}
