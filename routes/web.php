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

Route::group(['middleware' => 'auth'], function() {
	
	Route::get('/', function () {
	    return view('dashboard');
	});

	
	/*
	* Rotas para os Perfis de Usuários
	*/
	Route::group(['prefix' => 'perfis'], function() {
		Route::get('', 			['as' => 'perfis', 		'uses' => 'PerfilController@index']);
	});


	/*
	* Rotas para as Prefeituras
	*/
	Route::group(['prefix' => 'prefeituras'], function() {
		Route::get('', 			['as' => 'prefeituras', 		'uses' => 'PrefeiturasController@index']);
	});


	/*
	* Rotas para os Gêneros
	*/
	Route::group(['prefix' => 'generos'], function() {
		Route::get('', 			['as' => 'generos', 		'uses' => 'GenerosController@index']);
		Route::post('store', 	['as' => 'generos.store',	'uses' => 'GenerosController@store']);
	});
	

	/*
	* Rotas para os AJAX
	*/
	Route::get('generos/exclude/{id}',  'GenerosController@exclude');

});
	

/*
* Outros
*/
Auth::routes();
