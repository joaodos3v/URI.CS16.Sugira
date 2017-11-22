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
    return view('dashboard');
});

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

/*
* Rotas da API para o Aplicativo
*/
Route::get('/app-api/get/generos', 					'ApiController@getGeneros');
Route::get('/app-api/get/cidades', 					'ApiController@getCidades');

Route::post('/app-api/post/login', 					'ApiController@postLogin');
Route::post('/app-api/post/sugestoes/user',			'ApiController@postSugestoesUser');
Route::post('/app-api/post/novo/usuario', 			'ApiController@postUser');
Route::post('/app-api/post/teste/genero', 			'ApiController@testeGenero');


Route::group(['middleware' => 'auth'], function() {
	
	Route::get('/', function () {
	    return view('dashboard');
	});

	
	/*
	* Rotas para os Perfis de Usuários
	*/
	Route::group(['prefix' => 'perfis'], function() {
		Route::get('', 						['as' => 'perfis', 						'uses' => 'PerfilController@index']);
		Route::post('store',				['as' => 'perfis.store', 				'uses' => 'PerfilController@store']);
		Route::put('update', 				['as' => 'perfis.update',				'uses' => 'PerfilController@update']);
		Route::get('{id}/permissions', 		['as' => 'perfis.permissions',			'uses' => 'PerfilController@permissions']);
		Route::put('store/permissions/{id}',['as' => 'perfis.store.permissions', 	'uses' => 'PerfilController@storePermissions']);
	});


	/*
	* Rotas para as Prefeituras
	*/
	Route::group(['prefix' => 'prefeituras'], function() {
		Route::get('', 				['as' => 'prefeituras', 		'uses' => 'PrefeiturasController@index']);
		Route::get('create',		['as' => 'prefeituras.create', 	'uses' => 'PrefeiturasController@create']);
		Route::post('store',		['as' => 'prefeituras.store', 	'uses' => 'PrefeiturasController@store']);
		Route::get('edit/{id}',		['as' => 'prefeituras.edit', 	'uses' => 'PrefeiturasController@edit']);
		Route::put('update/{id}',	['as' => 'prefeituras.update', 	'uses' => 'PrefeiturasController@update']);
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
	* Rotas para os Usuários
	*/
	Route::group(['prefix' => 'usuarios'], function() {
		Route::get('', 						['as' => 'usuarios', 				'uses' => 'UsuariosController@index']);
		Route::get('edit', 					['as' => 'usuarios.edit', 			'uses' => 'UsuariosController@edit']);
		Route::post('update',				['as' => 'usuarios.update', 		'uses' => 'UsuariosController@update']);
		Route::get('edit/private', 			['as' => 'usuarios.edit.private', 	'uses' => 'UsuariosController@editPrivate']);
		Route::put('update/private/{id}', 	['as' => 'usuarios.update.private', 'uses' => 'UsuariosController@updatePrivate']);
	});


	/*
	* Rotas para os AJAX
	*/
	Route::get('generos/exclude/{id}',  	'GenerosController@exclude');
	Route::get('perfil/exclude/{id}',   	'PerfilController@exclude');
	Route::get('prefeituras/exclude/{id}',  'PrefeiturasController@exclude');
	Route::get('user/exclude/{id}',  		'UsuariosController@exclude');

});
	

/*
* Outros
*/
Auth::routes();

Route::get('/home', function () {
    return view('dashboard');
});
