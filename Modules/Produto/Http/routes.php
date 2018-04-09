<?php

Route::group(['middleware' => 'web', 'prefix' => 'produto', 'namespace' => 'Modules\Produto\Http\Controllers'], function()
{
    Route::group(array('prefix' => 'api'), function()
    {
      Route::get('/', function () {
          return response()->json(['message' => 'Laravel API', 'status' => 'Connected']);;
      });

      Route::resource('produtos', 'ProdutoController');
    });

    Route::get('/', function () {
        return redirect('api');
    });
});
