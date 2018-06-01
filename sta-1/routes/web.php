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

Route::get('/', function () {
    if(Auth::check()){
        return view('welcome');
    }
    return view('auth.login');
});

Auth::routes();
Route::middleware(['auth'])->group(function(){
    Route::get('/contrats/create/', 'ContratsController@create');
    Route::get('/contrats/create/{voiture_id}', 'ContratsController@create2');
    Route::get('/contrats/{client_id}/create', 'ContratsController@create');
    Route::resource('voitures', 'VoituresController');
    Route::resource('clients', 'ClientsController');
    Route::resource('contrats', 'ContratsController');
    Route::resource('payements', 'PayementsController');
    Route::get('/payements/create/{contrat_id}', 'PayementsController@create2');
    Route::get('/contrats/edit/{contrat_id}', 'ContratsController@edit2');
});


Route::get('/home', 'HomeController@index')->name('home');
