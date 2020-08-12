<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('/contacts');
});

//Route::get('search-results', 'ContactController@searchResults');

Route::resource('contacts', 'ContactController');

Route::post('/search', 'ContactController@search');

Route::get('add-email/{id}','ContactController@viewAddEmail');
Route::post('add-email/{id}', 'ContactController@addEmail');

Route::get('add-number/{id}','ContactController@viewAddNumber');
Route::post('add-number/{id}', 'ContactController@addNumber');
