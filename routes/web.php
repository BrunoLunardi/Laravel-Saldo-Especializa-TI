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

//rota inicial do site
Route::get('/', 'Site\SiteController@index');
//Route::get('/', 'SiteController@index');

//cria grupo de rotas (para garantir que só usuários autenticados acessarão estas rotas)
//'middleware' => 'auth' filtro para altenticação
//'namespace' => 'Admin' evita usar \Admin em todas as rotas
Route::group(['middleware' => ['auth'], 'namespace' => 'Admin'], function(){

    //rota para admin
        //->name('admin.home') nomeia a rota
    Route::get('admin', 'AdminController@index')->name('admin.home');

});



//Rotas para o Login
Auth::routes();
//Exibir página após o login
//Route::get('/home', 'HomeController@index')->name('home');
