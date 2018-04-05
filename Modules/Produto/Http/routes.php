<?php

Route::group(['middleware' => 'web', 'prefix' => 'produto', 'namespace' => 'Modules\Produto\Http\Controllers'], function()
{
    Route::get('/', 'ProdutoController@index');
});
