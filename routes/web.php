<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/lojista', 'EstabelecimentoController@index')->name('home');
Route::get('/cadastrar', 'EstabelecimentoController@create')->name('cadastrar_estabelecimento');
Route::post('/cadastrar', 'EstabelecimentoController@store')->name('cadastrar_estabelecimento');
Route::get('/lojista/{user}/{estabelecimento:slug}', 'EstabelecimentoController@show')->name('estabelecimento_home');
Route::get('/estabelecimento/{estabelecimento:slug}/mesas', 'MesaController@index')->name('mesas_index');
Route::post('/estabelecimento/{estabelecimento:slug}/mesa', 'MesaController@store')->name('mesas_store');
Route::patch('/estabelecimento/{estabelecimento:slug}/mesa/{mesa}', 'MesaController@update')->name('mesas_update');
Route::delete('/estabelecimento/{estabelecimento:slug}/mesa/{mesa}', 'MesaController@destroy')->name('mesas_destroy');
Route::get('/estabelecimento/{estabelecimento:slug}/cardapios', 'CardapioController@index')->name('cardapios_index');
Route::get('/estabelecimento/{estabelecimento:slug}/cardapios/{cardapio}', 'CardapioController@show')->name('cardapios_show');
Route::post('/estabelecimento/{estabelecimento:slug}/cardapios', 'CardapioController@store')->name('cardapios_store');
Route::delete('/estabelecimento/{estabelecimento:slug}/cardapios/{cardapio}', 'CardapioController@destroy')->name('cardapios_destroy');
Route::patch('/estabelecimento/{estabelecimento:slug}/cardapios/{cardapio}', 'CardapioController@update')->name('cardapios_update');

Route::post('/estabelecimento/{estabelecimento:slug}/cardapios/{cardapio}', 'CardapioController@selectCategoria')->name('cardapios_select_categoria');
Route::post('/estabelecimento/{estabelecimento:slug}/cardapios/{cardapio}/categoria/{categoria}', 'CardapioController@selectItem')->name('cardapios_select_item');

Route::delete('/cardapios/{cardapio}/categoria{categoria}', 'CardapioController@deleteCategoria')->name('cardapios_delete_categoria');
Route::delete('/cardapios/{cardapio}/categoria{categoria}/item{item}', 'CardapioController@deleteItem')->name('cardapios_delete_item');

Route::get('/estabelecimento/{estabelecimento:slug}/categorias', 'CategoriaController@index')->name('categorias_index');
Route::post('/estabelecimento/{estabelecimento:slug}/categoria', 'CategoriaController@store')->name('categorias_store');
Route::patch('/estabelecimento/{estabelecimento:slug}/categoria/{categoria}', 'CategoriaController@update')->name('categorias_update');
Route::delete('/estabelecimento/{estabelecimento:slug}/categoria/{categoria}', 'CategoriaController@destroy')->name('categorias_destroy');

Route::get('/estabelecimento/{estabelecimento:slug}/items', 'ItemController@index')->name('items_index');
Route::post('/estabelecimento/{estabelecimento:slug}/item', 'ItemController@store')->name('items_store');
Route::patch('/estabelecimento/{estabelecimento:slug}/item/{item}', 'ItemController@update')->name('items_update');
Route::delete('/estabelecimento/{estabelecimento:slug}/items/{item}', 'ItemController@destroy')->name('items_destroy');

Route::delete('/estabelecimento/{estabelecimento:slug}/complemento/{complemento}', 'ComplementoController@destroy')->name('complementos_destroy');

Route::delete('/estabelecimento/{estabelecimento:slug}/opcao/{opcao}', 'OpcaoController@destroy')->name('opcaos_destroy');