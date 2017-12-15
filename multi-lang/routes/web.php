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
	Route::get('/logout',['as' => 'logout', 'uses' => 'LoginController@logout']);
	Route::get('/panel', 'HomeController@index');


	Route::group(['prefix' => 'languages'], function() {
		Route::get('/', 'LanguageController@index');
		Route::get('/create', 'LanguageController@create');
		Route::post('/', 'LanguageController@store');
		Route::get('/{id}/edit', 'LanguageController@edit');
		Route::post('/{id}', 'LanguageController@update');
	});


	Route::group(['prefix' => 'modules'], function() {
		Route::get('/', 'ModuleController@index');
		Route::get('/create', 'ModuleController@create');
		Route::get('/{id}', 'ModuleController@show');
		Route::post('/', 'ModuleController@store');
		Route::get('/{id}/edit', 'ModuleController@edit');
		Route::post('/{id}', 'ModuleController@update');
		

		Route::get('/{id}/item/create', 'ItemController@create');
	});


	Route::group(['prefix' => 'item'], function() {
		Route::post('/', 'ItemController@store');
		Route::get('/{id}/edit', 'ItemController@edit');
		Route::post('/{id}', 'ItemController@update');
	});


	//problema si lo coloco dentro del group prefix=>modules
	

	Route::get('/module/{id_module}/language/{id_lang}/translation/create', 'TranslationController@create');
	Route::post('/translation', 'TranslationController@store');
	Route::get('/modules/{id_module}/translation/{id_translation}/edit', 'TranslationController@edit');
	Route::post('/translation/{id}', 'TranslationController@update');

	//Si no le agrego el /module/{id} lo manda al @update
	Route::post('/modules/{id}/translation/delete', 'TranslationController@destroy');

	//Problema si trato de eliminar dentro del prefix modules
	Route::post('/items/delete', 'ItemController@destroy');
	Route::post('/module/delete', 'ModuleController@destroy');
	Route::post('/language/delete', 'LanguageController@destroy');


	Route::post('/language/activate', 'LanguageController@activate');
});
