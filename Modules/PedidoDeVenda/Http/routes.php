<?php

Route::group(['middleware' => 'web', 'prefix' => 'pedidodevenda', 'namespace' => 'Modules\PedidoDeVenda\Http\Controllers'], function()
{
    Route::get('/', 'PedidoDeVendaController@index');
});
