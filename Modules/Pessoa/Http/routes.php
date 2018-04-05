<?php

Route::group(['middleware' => 'web', 'prefix' => 'pessoa', 'namespace' => 'Modules\Pessoa\Http\Controllers'], function()
{
    Route::get('/', 'PessoaController@index');
});
