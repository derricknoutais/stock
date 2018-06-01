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
    return view('welcome');
});

Route::get('/try', function(){
    $code = "CjOC4V9CKof2GyEEdPE0Y_aUPYTLhQdnHaHUczRI";
    $domain_prefix = "stapog";

    return view('request.token', compact('code', 'domain_prefix'));
});

Route::get('/api', function(){
    $ch = curl_init('https://stapog.vendhq.com/api/products/120');

    // Returns the data/output as a string instead of raw data
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Good practice to let people know who's accessing their servers. See https://en.wikipedia.org/wiki/User_agent
    curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');

    //Set your auth headers
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . 'CjOC4V9CKof2GyEEdPE0Y_5kKUYUfzRCOLpmjUsF'
        ));

    // get stringified data/output. See CURLOPT_RETURNTRANSFER
     $data = curl_exec($ch);

    // get info about the request
    $info = curl_getinfo($ch);

    // close curl resource to free up system resources 
    curl_close($ch);
    return (json_decode($data, true));
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
