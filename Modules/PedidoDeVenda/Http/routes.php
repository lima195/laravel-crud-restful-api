<?php

Route::group(['middleware' => 'web', 'prefix' => 'pedidodevenda', 'namespace' => 'Modules\PedidoDeVenda\Http\Controllers'], function()
{
    // Route::get('/', 'PedidoDeVendaController@index');

    Route::group(array('prefix' => 'api'), function()
    {
      Route::get('/', function () {
          return response()->json(['message' => 'Laravel API', 'status' => 'Connected']);;
      });

      Route::resource('pedidos', 'PedidoDeVendaController');
    });

    Route::get('/', function () {
        return redirect('api');
    });

});
