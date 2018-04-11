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
    public function index(Request $request)
    {
        if($request->params){
          $params = $request->all()['params'][0];

          $produtos = DB::table('produtos')
            ->whereNull('deleted_at');

          if(isset($params['codigo'])){
            $produtos->where('codigo', '=', $params['codigo']);
          }

          if(isset($params['nome'])){
            $produtos->where('nome', '=', $params['nome']);
          }

          if(isset($params['preco'])){
            $params['preco'] = (preg_replace('/[^0-9]/', '', $params['preco'])/100);
            $produtos->where('preco', '=', $params['preco']);
          }

          $produtos = $produtos->get();

        }else{
          $produtos = DB::table('produtos')
            ->whereNull('deleted_at')
            ->get();
        }

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

        $preco = (preg_replace('/[^0-9]/', '', $request['preco'])/100);

        $produto_save = array(
            'id' => null,
            'codigo' => $request['codigo'],
            'nome' => $request['nome'],
            'preco' => $preco
        );

        try{
          $produto = new Produto();
          $produto->fill($produto_save);
          $save = $produto->save();
        }catch(\Exception $e){
          $errorCode = $e->errorInfo;

          header('HTTP/1.1 406');
          header('Content-Type: application/json; charset=UTF-8');
          die(json_encode(array('message' => $errorCode[2], 'code' => $errorCode[1])));
        }

        return response()->json($produto_save);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $produto = Produto::find($id);
        if($produto){
          return response()->json($produto);
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

            $preco = (preg_replace('/[^0-9]/', '', $request['preco'])/100);

            $produto_save = array(
                'id' => $request['id'],
                'codigo' => $request['codigo'],
                'nome' => $request['nome'],
                'preco' => $preco
            );

            try{
              $produto = Produto::find($id);
              $produto->fill($produto_save);
              $save = $produto->save();
            }catch(\Exception $e){
              $errorCode = $e->errorInfo;
              header('HTTP/1.1 406');
              header('Content-Type: application/json; charset=UTF-8');
              die(json_encode(array('message' => $errorCode[2], 'code' => $errorCode[1])));
            }

        }else{
          header('HTTP/1.1 406');
          header('Content-Type: application/json; charset=UTF-8');
          die(json_encode(array('message' => 'Identificador não encontrado', 'code' => '1')));
        }

        return response()->json($save);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $produto = Produto::find($id);

        return response()->json($produto->delete());
    }
}
