<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'api'],function(){


    /*
     * Rotas para autenticação de usuários
     */
     Route::post('auth','Auth\AuthenticateController@authenticate'); // Autentica usuário
     Route::get('auth/user','Auth\AuthenticateController@getAuthenticatedUser'); // Retorna usuário autenticado

    /*
     * Rotas para cadastro e alteração de usuários
     */
     Route::resource('user','User\UserController');
     Route::post('user/password/{id}','User\UserController@updatePassword');
     Route::get('user/checkUnique/{username}/{id?}','User\UserController@checkUnique');
});
