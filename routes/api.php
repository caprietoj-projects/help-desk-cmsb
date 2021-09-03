<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Fichas Tecnicas
    Route::apiResource('fichas-tecnicas', 'FichasTecnicasApiController');
});
