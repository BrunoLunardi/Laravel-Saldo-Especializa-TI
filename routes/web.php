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
//Route::get('/', 'SiteController@index');

//cria grupo de rotas (para garantir que só usuários autenticados acessarão estas rotas)
//'middleware' => 'auth' filtro para altenticação
//'namespace' => 'Admin' evita usar \Admin em todas os Controllers
//'prefix' => 'admin' evita colocar admin em todas as rotas
Route::group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function(){

    //rota para admin
        //->name('admin.home') nomeia a rota
    //rota acessada após realizar login
    Route::get('/', 'AdminController@index')->name('admin.home');

    //rota inicial
    Route::get('balance', 'BalanceController@index')->name('admin.balance');
    //rota para deposito (será acessada do botão recarga de resources/views/admin/balance/index.blade.php)
    Route::get('deposit', 'BalanceController@deposit')->name('balance.deposit');
    //rota que charmará controller para armazenar o valor do deposito (acessada pelo botão recarrega de resources/views/admin/balance/deposit.blade.php )
    Route::post('deposit', 'BalanceController@depositStore')->name('deposit.store');

    //rota para sacar (será acessada pelo botão Sacar de resources/views/admin/balance/index.blade.php)
    Route::get('withdraw', 'BalanceController@withdraw')->name('balance.withdraw');
    //rota para sacar no BD (será acessada pelo form de resources/views/admin/balance/withdraw.blade.php)
    Route::post('withdraw', 'BalanceController@withdrawStore')->name('withdraw.store');


});

//rota inicial do site
Route::get('/', 'Site\SiteController@index');

//Rotas para o Login
Auth::routes();
//Exibir página após o login
//Route::get('/home', 'HomeController@index')->name('home');
