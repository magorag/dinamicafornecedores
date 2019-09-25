<?php

// Route::get('servicos', 'API\ServicoController@index');
// Route::post('servicos', 'API\ServicoController@store');
// Route::put('servicos/{id}', 'API\ServicoController@update');
// Route::delete('servicos/{id}', 'API\ServicoController@destroy');
//
//Route::post('login', 'API\UserController@login');
//Route::post('register', 'API\UserController@register');
//Route::group(['middleware' => 'auth:api'], function(){
//    Route::post('details', 'API\UserController@details');
//});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login'); // login
    Route::post('signup', 'AuthController@signup'); // cadastrar o usuario e nao o fornecedor

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout'); // logout
        Route::get('user', 'AuthController@user'); // usuario logado
    });
});



Route::get('servicos/{id}/fornecedors', 'API\ServicoController@fornecedors');
Route::apiResource('servicos', 'API\ServicoController');

Route::apiResource('fornecedor', 'API\FornecedorController');

Route::get('cadastro', 'API\CadastroController@index'); //gera a hash
Route::post('cadastro', 'API\CadastroController@store'); // salva a hash no banco
Route::put('cadastro/{id}', 'API\CadastroController@update'); //edita a hash
Route::get('cadastro/{hash}', 'API\CadastroController@id'); //varificar se a hash ta no banco
