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
    return redirect()->route('posts.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/posts', 'PostController');
Route::resource('/posts.comments', 'CommentController')->only(['store']);
Route::resource('/comments', 'CommentController')->only(['update', 'destroy']);