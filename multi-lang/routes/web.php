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


Route::get('/', ['middleware' => 'auth', 'uses' => function () {
    return redirect('panel');
}]);

Route::get('/login',['as' => 'login', 'uses' => 'LoginController@login']);
Route::post('/login',['as' => 'login', 'uses' => 'LoginController@auth']);



Route::group(['middleware' => 'auth'], function() {

	Route::get('/panel', 'HomeController@index');


	Route::group(['prefix' => 'languages'], function() {
		Route::post('/update', 'LanguageController@update');
	});


	Route::group(['prefix' => 'modules'], function() {
		Route::get('/create', 'ModuleController@create');
		Route::get('/{id}', 'ModuleController@show');
		Route::post('/', 'ModuleController@store');
		Route::get('/{id}/edit', 'ModuleController@edit');
		Route::post('/{id}', 'ModuleController@update');
		

		Route::get('/{id}/item/create', 'ItemController@create');
		Route::post('/item/', 'ItemController@store');
		Route::get('/item/{id}/edit', 'ItemController@edit');
		Route::post('/item/{id}', 'ItemController@update');
	
	});

	//problema si lo coloco dentro del group prefix=>modules
	Route::post('/item/delete', 'ItemController@destroy');


	Route::get('/module/{id_module}/language/{id_lang}/translation/create', 'TranslationController@create');
	Route::post('/translation', 'TranslationController@store');
	Route::get('/modules/{id_module}/translation/{id_translation}/edit', 'TranslationController@edit');
	Route::post('/translation/{id}', 'TranslationController@update');

	//Si no le agrego el /module/{id} lo manda al @update
	Route::post('/modules/{id}/translation/delete', 'TranslationController@destroy');

	//Problema si trato de eliminar dentro del prefix modules
	Route::post('/module/delete', 'ModuleController@destroy');
});
