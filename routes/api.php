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

Route::post('/register', 'App\Http\Controllers\API\UserController@register');
Route::post('/login', 'App\Http\Controllers\API\UserController@login');
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/users', 'App\Http\Controllers\API\UserController@users');
    Route::get('/alluser', 'App\Http\Controllers\API\UserController@alluser');
    Route::get('/blog', 'App\Http\Controllers\API\BlogController@index');
    Route::get('/blog/{id}', 'App\Http\Controllers\API\BlogController@show');
    Route::post('/blog', 'App\Http\Controllers\API\BlogController@store');
    Route::put('/blog/{id}', 'App\Http\Controllers\API\BlogController@update');
    Route::delete(
        '/blog/{id}',
        'App\Http\Controllers\API\BlogController@destroy'
    );
    Route::get(
        '/blog/category',
        'App\Http\Controllers\API\BlogCategoryController@index'
    );
    Route::get(
        '/blog/category/{id}',
        'App\Http\Controllers\API\BlogCategoryController@show'
    );
    Route::put(
        '/blog/category/{id}',
        'App\Http\Controllers\API\BlogCategoryController@update'
    );
    Route::post(
        '/blog/category',
        'App\Http\Controllers\API\BlogCategoryController@store'
    );
    Route::delete(
        '/blog/category/{id}',
        'App\Http\Controllers\API\BlogCategoryController@destroy'
    );
    Route::get('/contact', 'App\Http\Controllers\API\ContactController@index');
    Route::get(
        '/contact/{id}',
        'App\Http\Controllers\API\ContactController@show'
    );
    Route::put(
        '/contact/{id}',
        'App\Http\Controllers\API\ContactController@update'
    );
    Route::delete(
        '/contact/{id}',
        'App\Http\Controllers\API\ContactController@destroy'
    );
    Route::post('/contact', 'App\Http\Controllers\API\ContactController@store');
});
