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
    //return redirect('/welcome');
    $page = \App\Page::where('title','welcome')->first();
    return view('page.show', ['page'=>$page]);
});

Route::resource('species', 'SpeciesController');
Route::resource('islands', 'IslandController');
Route::resource('pages', 'PageController');

Route::get('/{page}',function($title){
    // todo: dry
    $page = \App\Page::where('title',$title)->first();
    return view('page.show', ['page'=>$page]);
});