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


Route::get('species/r', 'SpeciesController@random');
Route::resource('species', 'SpeciesController');
Route::get('species/{species}/pdf', 'SpeciesController@pdf')->name('species.pdf');

Route::get('book', 'PageController@book')->name('book');

Route::resource('islands', 'IslandController');

/* Auth */

Auth::routes();
// empêche la création de compte
Route::match(['get', 'post'], 'register', function(){
    return redirect('/');
});

/* Pages */

Route::resource('pages', 'PageController', ['except' => [
    'show'
]]);
Route::get('/',  'PageController@show');
Route::get('/{page}', 'PageController@show')->name('pages.show');