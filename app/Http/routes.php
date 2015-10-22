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
     Route::post('auth', 'Auth\AuthenticateController@authenticate')->name('post.auth'); // Autentica usuário
     Route::get('auth/user', 'Auth\AuthenticateController@getAuthenticatedUser')->name('get.auth'); // Retorna usuário autenticado

     /*
      * Rotas para recuperação de senha
      */
     Route::post('password/email', 'Auth\PasswordController@postEmail')->name('post.password.email');
     Route::post('password/reset', 'Auth\PasswordController@postReset')->name('post.passwor.reset');


     /*
      * Rotas protegidas por autenticação
      */
     Route::group(['middleware'=>['jwt.auth','acl']], function(){
        /*
         * Rotas para cadastro e alteração de usuários
         */
         Route::get('user', 'User\UserController@index')->name('get.user');
         Route::post('user','User\UserController@store')->name('post.user');
         Route::put('user/{id}', 'User\UserController@update')->name('put.user');
         Route::delete('user/{id}', 'User\UserController@destroy')->name('delete.user');

         Route::post('user/password/{id}', 'User\UserController@updatePassword')->name('post.user.password');
         Route::get('user/checkUnique/{username}/{id?}', 'User\UserController@checkUnique')->name('get.user.checkunique');

     });
});
