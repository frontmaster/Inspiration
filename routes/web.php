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
Route::post('/profile/{id}', 'ProfilesController@update')->name('update');
Route::get('/password/change/{id}', 'Auth\ChangePasswordController@edit');
Route::post('/password/change/{id}','Auth\ChangePasswordController@update')->name('password.change');
Route::get('/post_idea/{id}', 'PostIdeasController@index')->name('post_idea');
Route::post('/post_idea/{id}', 'PostIdeasController@create')->name('post_idea');
Route::get('/post_idea_list/{id}', 'PostIdeaListsController@index')->name('post_idea_list');
Route::get('ajax/post_idea_list/{id}', 'Ajax\PostIdeaListsController@index');
Route::get('/post_idea_edit/{id}', 'PostIdeasController@edit')->name('post_idea_edit');

});
