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

use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

Route::get('/mypage/{id}', 'HomeController@show')->name('mypage');
Route::post('users_delete/{id}', 'UsersController@destroy')->name('deleteUsers');
Route::get('users_delete_confirm/{id}', 'UsersController@delete_confirm')->name('users.delete_confirm');
Route::get('/profile/{id}', 'ProfilesController@edit')->name('profile');
Route::post('/profile/{id}', 'ProfilesController@store')->name('store');
});
