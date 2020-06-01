<?php

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


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function(){

    /** Formulário de Login*/
    Route::get('/', 'AuthController@showLoginForm')->name('login');
    Route::post('login', 'AuthController@login')->name('login.do');

    /** Rotas Protegidas */
    Route::group(['middleware' => ['auth']], function (){

        /** Painel de Controle */
        Route::get('home', 'AuthController@home')->name('home');

        /** Usuários e Alunos */
        Route::get('users/team', 'UserController@team')->name('users.team');
        Route::resource('users', 'UserController');

        /** Cursos */
        Route::resource('courses', 'CourseController');

        /** Séries */
        Route::resource('series', 'SerieController');

        /** Turmas */
        Route::get('groups/{uri}/list', 'GroupController@list')->name('groups.list');
        Route::resource('groups', 'GroupController');

        /** Settings */
        Route::resource('system', 'SystemController');
        Route::resource('banks', 'BankController');
        Route::resource('buttons', 'ButtonsController');
        Route::resource('terms', 'TermController');


    });

    /** Logout */
    Route::get('logout', 'AuthController@logout')->name('logout');

});
