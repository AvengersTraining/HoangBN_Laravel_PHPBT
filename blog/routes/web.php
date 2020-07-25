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
Route::group(['namespace' => 'User', 'middleware' => ['auth:web']], function () {
    Route::get('/profile', 'UserController@profile')->name('profile');
    Route::get('/edit', 'UserController@edit')->name('edit');
    Route::post('/update', 'UserController@update')->name('update');
});

Route::resource('tags', 'Tag\TagController', ['middleware' => ['auth:web', 'admin']]);
