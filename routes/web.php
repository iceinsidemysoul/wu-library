<?php

/*
 * for spa public
*/
Route::get('/', 'PageController@spa_public');

Route::get('/post/{id}', 'PageController@post_show');

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('admin');
Route::group(['prefix' => 'admin', "as" => "admin.", 'middleware'=> ['auth']], function(){
	Route::get('/admin/{vue_capture?}', 'HomeController@index')->where('vue_capture', '[\/\w\.-]*');
});
Route::get('/timeline', 'PostController@timeline');
// Route::get('/posts/filter', 'PostController@filter');
Route::resource('posts', 'PostController');
Route::resource('categories', 'CategoryController');
