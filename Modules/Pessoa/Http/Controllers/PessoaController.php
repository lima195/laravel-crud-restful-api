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
        $pessoas = DB::table('pessoas')
        ->whereNull('deleted_at')
        ->get();

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

        list($dia, $mes, $ano) = explode('/', $request['nascimento']);
        $date = $ano."/".$mes."/".$dia;

        $pessoa_save = array(
            'id' => null,
            'nome' => $request['nome'],
            'cpf' => $request['cpf'],
            'nascimento' => $date
        );

        try{
          $pessoa = new Pessoa();
          $pessoa->fill($pessoa_save);
          $save = $pessoa->save();
        }catch(\Exception $e){
          $errorCode = $e->errorInfo;
          header('HTTP/1.1 406');
          header('Content-Type: application/json; charset=UTF-8');
          die(json_encode(array('message' => $errorCode[2], 'code' => $errorCode[1])));
        }

        return response()->json($pessoa_save);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $pessoa = Pessoa::find($id);
        if($pessoa){
          list($ano, $mes, $dia) = explode('-', $pessoa->nascimento);
          $pessoa->nascimento = $dia."/".$mes."/".$ano;
          $pessoa->pedidos = $pessoa->first()->pedidos;
          return response()->json($pessoa);
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

            list($dia, $mes, $ano) = explode('/', $request['nascimento']);
            $date = $ano."/".$mes."/".$dia;

            $pessoa_save = array(
              'id' => $request['id'],
              'nome' => $request['nome'],
              'cpf' => $request['cpf'],
              'nascimento' => $date
            );

            try{
              $pessoa = Pessoa::find($id);
              $pessoa->fill($pessoa_save);
              $save = $pessoa->save();
            }catch(\Exception $e){
              $errorCode = $e->errorInfo;
              header('HTTP/1.1 406');
              header('Content-Type: application/json; charset=UTF-8');
              die(json_encode(array('message' => $errorCode[2], 'code' => $errorCode[1])));
            }
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
