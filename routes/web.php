<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('cadastro', 'API\CadastroController@index');
//Route::post('cadastro', 'API\CadastroController@store');
//Route::get('valorGerado', 'API\CadastroController@valor');
