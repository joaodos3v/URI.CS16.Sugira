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
		Route::get('', 					['as' => 'perfis', 				'uses' => 'PerfilController@index']);
		Route::post('store',			['as' => 'perfis.store', 		'uses' => 'PerfilController@store']);
		Route::put('update', 			['as' => 'perfis.update',		'uses' => 'PerfilController@update']);
		Route::get('{id}/permissions', 	['as' => 'perfis.permissions',	'uses' => 'PerfilController@permissions']);
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
		Route::get('', 				['as' => 'generos', 		'uses' => 'GenerosController@index']);
		Route::post('store', 		['as' => 'generos.store',	'uses' => 'GenerosController@store']);
		Route::put('update', 		['as' => 'generos.update',	'uses' => 'GenerosController@update']);
	});
	

	/*
	* Rotas para os AJAX
	*/
	Route::get('generos/exclude/{id}',  'GenerosController@exclude');
	Route::get('perfil/exclude/{id}',   'PerfilController@exclude');

});
	

/*
* Outros
*/
Auth::routes();
