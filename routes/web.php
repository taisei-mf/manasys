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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/mil','ManasysController@showMil')->name('mil');
//Route::get('/mil', function () {
//    return view('mil');
//});

Route::get('/mnr','ManasysController@showMnr')->name('mnr');
//Route::get('/mnr', function () {
//    return view('mnr');
//});

Route::get('/mid','ManasysController@showMid')->name('mid');
//Route::get('/mid', function () {
//    return view('mid');
//});

Route::get('/mie','ManasysController@showMie')->name('mie');
//Route::get('/mie', function () {
//    return view('mie');
//});