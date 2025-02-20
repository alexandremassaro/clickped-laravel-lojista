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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('auth/login', 'Api\AuthController@login');
Route::post('auth/register', 'Api\AuthController@register');
Route::post('auth/refresh', 'Api\AuthController@refresh');

Route::group(['middleware' => ['apiJwt']], function () {
    Route::get('users', 'Api\UserController@index');
    Route::post('auth/logout', 'Api\AuthController@logout');
    Route::post('auth/me', 'Api\AuthController@me');
    Route::get('cardapio', 'Api\CardapioController@show');
    Route::get('mesa/{mesa}', 'Api\EstabelecimentoController@checkIn');
});


Route::post('/item', 'Api\ItemController@store')->name('item_store');
Route::post('/complemento', 'Api\ComplementoController@store')->name('complemento_store');
Route::post('/opcao', 'Api\OpcaoController@store')->name('opcao_store');
Route::get('/categorias/autocomplete', 'Api\CategoriaController@getCategoriasArray')->name('getCategoriasArray');
Route::get('/items/autocomplete', 'Api\ItemController@getItemsArray')->name('getItemsArray');

Route::get('/pedidos/recentes', 'Api\PedidoController@getRecentes')->name('getPedidosRecentes');
Route::post('/pedido/status', 'Api\PedidoController@changeStatus')->name('changeStatusPedido');