<?php

/*
 * for spa public
*/
Route::get('/', 'PageController@spa_public');

Route::get('/post/{id}', 'PageController@post_show');

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('admin');
Route::group(['prefix' => 'admin', "as" => "admin.", 'middleware'=> ['auth']], function(){
	Route::get('posts', 'PostController@adminIndex');
	Route::post('posts', 'PostController@store');
	Route::get('posts/create', 'PostController@create');
	Route::get('posts/{id}/edit', 'PostController@edit');
	Route::patch('posts/{post}', 'PostController@update');
	Route::delete('posts/{post}', 'PostController@destroy');
	Route::resource('surveys', 'SurveyController', ['only' => ['index', 'destroy']]);
	Route::get('{vue_capture?}', 'HomeController@spa')->where('vue_capture', '[\/\w\.-]*');
});
Route::post('/surveys', 'SurveyController@store');
Route::get('/timeline', 'PostController@timeline');
Route::get('posts', 'PostController@index');
Route::get('posts/{post}', 'PostController@show');
Route::resource('categories', 'CategoryController');
