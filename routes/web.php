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

Route::get('/', 'TopPageController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

Route::get('/mypage/{id}', 'MypagesController@index')->name('mypage');
Route::post('users_delete/{id}', 'UsersController@delete')->name('deleteUsers');
Route::get('users_delete_confirm/{id}', 'UsersController@delete_confirm')->name('users.delete_confirm');
Route::get('/profile/{id}', 'ProfilesController@edit')->name('profile');
Route::post('/profile/{id}', 'ProfilesController@update')->name('profile_update');
Route::get('/password/change/{id}', 'Auth\ChangePasswordController@edit');
Route::post('/password/change/{id}','Auth\ChangePasswordController@update')->name('password.change');
Route::get('/post_idea/{id}', 'PostIdeasController@index')->name('post_idea_show');
Route::post('/post_idea/{id}', 'PostIdeasController@create')->name('post_idea_create');
Route::get('/post_idea_list/{id}', 'PostIdeaListsController@index')->name('post_idea_list_show');
Route::get('ajax/post_idea_list/{id}', 'Ajax\PostIdeaListsController@index');
Route::get('/post_idea_edit/{id}', 'PostIdeasController@edit')->name('post_idea_edit');
Route::post('/post_idea_edit/{id}', 'PostIdeasController@update')->name('post_idea_update');
Route::delete('/post_idea_edit/{id}', 'PostIdeasController@delete')->name('idea_delete_post');
Route::get('/idea_detail/{id}', 'PostIdeasController@detail')->name('idea_detail');
Route::post('/idea_detail/{id}', 'PostIdeasController@buy')->name('idea_buy');
Route::put('/idea_detail/{id}', 'ReviewsController@review')->name('idea_review');
Route::post('/idea/like/{id}', 'PostIdeasController@like')->name('idea_like');
Route::get('/idea_list', 'IdeaListsController@index')->name('idea_lists');
Route::get('ajax/idea_list', 'Ajax\IdeaListsController@index');
Route::get('ajax/like_idea_list/{id}', 'Ajax\LikeIdeasController@index');
Route::get('/like_idea_list/{id}', 'LikeIdeasController@index')->name('like_idea_lists');
Route::get('/bought_idea_list/{id}', 'BoughtIdeasController@index')->name('bought_idea_lists');
Route::get('ajax/bought_idea_list/{id}', 'Ajax\BoughtIdeasController@index');
Route::get('ajax/review_list', 'Ajax\ReviewsController@index');
Route::get('/review_list/{id}', 'ReviewsController@index')->name('review_lists');
Route::get('/review_edit/{id}', 'ReviewsController@edit')->name('review_edit');
Route::post('/review_edit/{id}', 'ReviewsController@update')->name('review_update');
});
