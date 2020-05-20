<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('user/', 'UserController@search'); // provides ability to search by params ...
Route::get('user/{id}', 'UserController@getById');
Route::get('user/{userId}/post', 'UserController@getPostByUserId');

Route::get('post/', 'PostController@search');
Route::get('post/{postId}/comment', 'PostController@getCommentByPostId');
