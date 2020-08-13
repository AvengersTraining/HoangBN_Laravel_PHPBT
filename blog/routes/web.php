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

Route::prefix('users')->namespace('User')->group(function () {
    Route::middleware(['auth:web'])->group(function () {
        Route::get('{user}', 'UserController@show')->name('users.show');
        Route::get('{user}/edit', 'UserController@edit')->name('users.edit');
        Route::put('{user}', 'UserController@update')->name('users.update');
    });
});

Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::middleware(['auth:web', 'admin'])->group(function () {
        Route::get('', 'AdminController@index')->name('admins.index');
        Route::delete('{user}', 'AdminController@destroy')->name('admins.destroy');
    });
});

Route::resource('tags', 'Tag\TagController', ['middleware' => ['auth:web', 'admin']]);
Route::resource('posts', 'PostController', ['middleware' => ['auth:web']]);
