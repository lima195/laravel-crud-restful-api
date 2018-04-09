<?php

Route::group(['middleware' => 'web', 'prefix' => 'pessoa', 'namespace' => 'Modules\Pessoa\Http\Controllers'], function()
{
    Route::group(array('prefix' => 'api'), function()
    {
      Route::get('/', function () {
          return response()->json(['message' => 'Laravel API', 'status' => 'Connected']);;
      });

      Route::resource('pessoas', 'PessoaController');
    });

    Route::get('/', function () {
        return redirect('api');
    });
});
