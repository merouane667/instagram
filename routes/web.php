<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/profiles/{user}','ProfileController@show')->name('profiles.show');

Route::get('/profiles/{user}/edit' , 'ProfileController@edit')->name('profiles.edit');

Route::patch('/profiles/{user}' , 'ProfileController@update')->name('profiles.update');

Route::get('/posts','PostController@index')->name('posts.index');


Route::get('/posts/create','PostController@create')->name('posts.create');

Route::post('/posts','PostController@store')->name('posts.store');

Route::get('/posts/{post}','PostController@show')->name('posts.show');

Route::post('/follows/{profile}' , 'FollowController@store')->name('follow.store');

Route::get('/delete_post/{user}/{post}','PostController@destroy')->name('post.delete');

Route::redirect('/home', '/posts');

Route::redirect('/', '/posts');

Route::post('/like', 'PostController@like')->name('posts.like');
Route::post('/comment', 'PostController@comment')->name('posts.comment');

Route::get('/comment/{comment_id}', 'PostController@delete_comment')->name('posts.delete_comment');