<?php

Route::get('/', function () {
    return view('welcome');
});

// Bloco de rotas da API
Route::group(['prefix' => 'api'], function () {

    /*
    * Rotas para autenticação de usuários
    */
    // Autentica usuário
    Route::post('auth', 'Auth\AuthenticateController@authenticate');

    // Retorna usuário autenticado
    Route::get('auth/user', 'Auth\AuthenticateController@getAuthenticatedUser');

    /*
    * Rotas para recuperação de senha
    */
    Route::post('password/email', 'Auth\PasswordController@postEmail');
    Route::post('password/reset', 'Auth\PasswordController@postReset');

    /*
    * Rotas protegidas por autenticação e acls
    */
    Route::group(['prefix' => 'user', 'middleware' => ['jwt.auth', 'acl']], function () {
        /*
        * Rotas para cadastro e alteração de usuários
        */
        Route::get('', 'User\UserController@index')
        ->name('listar.usuario');

        Route::post('', 'User\UserController@store')
        ->name('cadastrar.usuario');

        Route::put('{id}', 'User\UserController@update')
        ->name('alterar.usuario');

        Route::delete('{id}', 'User\UserController@destroy')
        ->name('deletar.usuario');

        Route::post('{id}/password', 'User\UserController@updatePassword')
        ->name('alterar.senha.usuario');

    });

    /*
    * Rotas protegidas por autenticação e acls
    */
    Route::group(['prefix' => 'group', 'middleware' => ['jwt.auth', 'acl']], function () {
        /*
        * Rotas para cadastro e alteração de usuários
        */
        Route::get('', 'User\GroupController@index')
        ->name('listar.grupo');

        Route::post('', 'User\GroupController@store')
        ->name('cadastrar.grupo');

        Route::put('{id}', 'User\GroupController@update')
        ->name('alterar.grupo');

        Route::delete('{id}', 'User\GroupController@destroy')
        ->name('deletar.grupo');

    });

    /*
    * Rotas protegidas por autenticação e acls
    */
    Route::group(['prefix' => 'rule', 'middleware' => ['jwt.auth', 'acl']], function () {
        /*
        * Rota para listar de permissões
        */
        Route::get('', 'User\RuleController@index')
        ->name('listar.rotas');
    });

    /*
    * Rotas protegidas por autenticação
    */
    Route::group(['middleware' => ['jwt.auth']], function () {
        /*
        * Rota para validar username
        */
        Route::get('user/unique/{username}/{id?}', 'User\UserController@unique');

        /*
        * Rotas para cadasto de Acls
        */
        Route::get('user/group', 'Auth\AclController@getGroup');
        Route::get('rule', 'Auth\AclController@getRule');
    });

});
