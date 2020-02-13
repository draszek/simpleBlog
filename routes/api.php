<?php

use Illuminate\Support\Facades\Route;


Route::post('/register', 'UserController@postRegister');
Route::post('/login', 'UserController@postLogin');
Route::post('/logout', 'UserController@postLogout');
Route::apiResource('/posts', 'PostController')->only(['index', 'show']);
Route::group(['middleware' => ['auth:api']], function () {
    Route::group(['middleware' => ['type:redactor']], function () {
        Route::apiResource('/posts', 'PostController')->only(['update', 'destroy', 'store']);
    });
    Route::group(['middleware' => ['type:administrator']], function () {
        Route::get('/users', 'UserController@index');
        Route::delete('/users/{id}', 'UserController@destroy');
        Route::put('/users/{id}', 'UserController@changeType');
    });
});
Route::post('/upload-image', 'PostController@postUploadImage');

