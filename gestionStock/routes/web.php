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
    return view('/home');
});

Auth::routes();

//Produits
Route::get('/produits', 'ProductController@index');
Route::post('/produits', 'ProductController@search');
Route::get('/produits/{name}', 'ProductController@show');
Route::get('/produits/info/{id}', 'ProductController@getProductInfo')->where('id', '[0-9]+');;
Route::get('/produits/category/{type}', 'ProductController@showProductsCategory');

Route::get('/produit-finis', 'FinalProductController@index');
Route::get('/produit-finis/{name}', 'FinalProductController@show');


Route::get('/bon-commande','StockOrderController@index');
Route::get('/bon-commande/nouveau/{id}','StockOrderController@create');
Route::post('/bon-commande/nouveau', 'StockOrderController@store');

//Route::post('/bon-achat','StockOrderController@store');
Route::post('/bon-achat-produit','StockOrderController@storeProduct');
Route::get('/bon-commande/{id}','StockOrderController@show')->where('id', '[0-9]+');



//Validate Stock Order
Route::get('/bon-commande/{id}/daf-valide','StockOrderController@dafSigning')->where('id', '[0-9]+');
Route::get('/bon-commande/{id}/dg-valide','StockOrderController@dgSigning')->where('id', '[0-9]+');
Route::get('/bon-commande/{id}/recevoir-stock','StockOrderController@receiveStock')->where('id', '[0-9]+');
Route::post('bon-commande/{id}/frais','StockOrderController@storeFees')->where('id', '[0-9]+');
//Edit Order
Route::get('/bon-achat/{id}/edit', 'StockOrderController@edit')->where('id', '[0-9]+');


Route::get('/demande-achat', 'PurchaseRequestController@index');
Route::get('/demande-achat/nouveau', 'PurchaseRequestController@create');
Route::get('/demande-achat/{id}', 'PurchaseRequestController@show')->where('id', '[0-9]+');
Route::post('/demande-achat', 'PurchaseRequestController@store');
Route::post('/demande-achat-produit', 'PurchaseRequestController@storeProduct');


Route::get('/bon-vente', 'SaleOrderController@index');
Route::get('/bon-vente/nouveau', 'SaleOrderController@create');
Route::post('/bon-vente', 'SaleOrderController@store');
Route::get('/bon-vente/{id}', 'SaleOrderController@show')->where('id', '[0-9]+');
Route::post('/bon-vente-produit', 'ProductSaleOrderController@store');


Route::get('/save-purchase-request/{id}', function($id){
    App\PurchaseRequest::find($id)->update([
        'saved' => 1
    ]);
});
Route::get('/save-sale-order/{id}', function($id){
    App\SaleOrder::find($id)->update([
        'saved' => 1
    ]);
});

Route::get('/home', 'HomeController@index')->name('home');









Route::get('api/demande-achat', 'PurchaseRequestController@apiIndex');