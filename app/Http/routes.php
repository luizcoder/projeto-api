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
     Route::post('auth', 'Auth\AuthenticateController@authenticate')->name('autenticar.usuario'); // Autentica usuário
     Route::get('auth/user', 'Auth\AuthenticateController@getAuthenticatedUser')->name('listar.usuario.autenticado'); // Retorna usuário autenticado

     /*
      * Rotas para recuperação de senha
      */
     Route::post('password/email', 'Auth\PasswordController@postEmail')->name('post.password.email');
     Route::post('password/reset', 'Auth\PasswordController@postReset')->name('post.passwor.reset');


     /*
      * Rotas protegidas por autenticação e acls
      */
     Route::group(['middleware'=>['jwt.auth','acl']], function(){
        /*
         * Rotas para cadastro e alteração de usuários
         */
         Route::get('user', 'User\UserController@index')->name('listar.usuario');
         Route::post('user','User\UserController@store')->name('cadastrar.usuario');
         Route::put('user/{id}', 'User\UserController@update')->name('alterar.usuario');
         Route::delete('user/{id}', 'User\UserController@destroy')->name('deletar.usuario');
         Route::post('user/password/{id}', 'User\UserController@updatePassword')->name('alterar.senha.usuario');



     });

     /*
      * Rotas protegidas por autenticação
      */
     Route::group(['middleware'=>['jwt.auth']], function(){
        /*
        * Rota para validar username
        */
        Route::get('user/checkUnique/{username}/{id?}', 'User\UserController@checkUnique')->name('checar.username.usuario');

        /*
        * Rotas para cadasto de Acls
        */
        Route::get('group', 'Auth\AclController@getGroup')->name('listar.grupos');
        Route::get('rule', 'Auth\AclController@getRule')->name('listar.permissoes');
      });
});
