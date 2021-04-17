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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts' , 'PostController@index');
Route::get('/getUser/{id}' , 'PostController@getUser');
Route::prefix('/post')->group(function(){
    Route::post('/store'  , 'PostController@store');
    Route::delete('/{id}'  , 'PostController@destroy');
    Route::put('/{id}'  , 'PostController@update');
    Route::get('/{id}'  , 'PostController@getPost');
});

Route::get('/comments/{id}' , 'CommentController@index');

Route::prefix('/comment')->group(function(){
    Route::post('/store'  , 'CommentController@store');
    Route::delete('/{id}'  , 'CommentController@destroy');
    Route::put('/{id}'  , 'CommentController@update');
    Route::get('/getOwner/{id}' , 'CommentController@getOwner');
});
