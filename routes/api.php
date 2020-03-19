<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/registrar','ApiControllers\UserController@registrar');
Route::get('/user', 'ApiControllers\UserController@index');
Route::get('/user/{id}', 'ApiControllers\UserController@index');
Route::put('updateuser/{id}', 'ApiControllers\UserController@update');
Route::delete('deleteuser/{id}', 'ApiControllers\UserController@destroy');

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'ApiControllers\AuthController@login'); // login
    Route::post('signup', 'ApiControllers\AuthController@signup'); // cadastrar o usuario e nao o fornecedor

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'ApiControllers\AuthController@logout'); // logout
        Route::get('user', 'ApiControllers\AuthController@user'); // usuario logado
    });
});

Route::get('servicos/{id}/fornecedors', 'API\ServicoController@fornecedors');
Route::Resource('servicos', 'ApiControllers\ServicoController');
Route::Resource('estados', 'ApiControllers\EstadoController');

Route::post('fornecedores', 'ApiControllers\FornecedorController@store');

Route::apiResource('/fornecedores', 'ApiControllers\FornecedorController');
Route::get('cadastro', 'ApiControllers\CadastroController@index'); //gera a hash
Route::post('cadastro', 'ApiControllers\CadastroController@store'); // salva a hash no banco
Route::put('cadastro/{id}', 'ApiControllers\CadastroController@update'); //edita a hash
Route::get('cadastro/{hash}', 'ApiControllers\CadastroController@id'); //varificar se a hash ta no banco
