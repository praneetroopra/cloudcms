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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/post','BlogsController@index');
Route::get('/post/create','BlogsController@create');
Route::post('/post/store','BlogsController@store');
Route::get('/post/{slug}','BlogsController@show');
Route::get('/post/{id}/edit','BlogsController@edit');
Route::put('/post/{id}','BlogsController@update')->name('blogs.update');
Route::delete('/post/{id}','BlogsController@destroy');

Route::get('/category','CategoriesController@index');
Route::get('/category/create','CategoriesController@create');
Route::post('/category/store','CategoriesController@store');
Route::get('/category/{id}','CategoriesController@show');
Route::get('/category/{id}/edit','CategoriesController@edit');
Route::put('/category/{id}','CategoriesController@update')->name('categories.update');
Route::delete('/category/{id}','CategoriesController@destroy');