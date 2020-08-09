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

Route::get('/lojista', 'HomeController@index')->name('home');
Route::get('/cadastrar', 'EstabelecimentoController@create')->name('cadastrar_estabelecimento');

Route::resource('estabelecimento', 'EstabelecimentoController');
